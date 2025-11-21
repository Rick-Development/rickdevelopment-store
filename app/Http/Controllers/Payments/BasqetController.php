<?php

namespace App\Http\Controllers\Payments;

use App\Events\TransactionPaid;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Helpers\BillwayHelper;
use App\Helpers\SafeHeaven\VirtualAccount;
use Rick\Basqet\Services\BasqetServices;
use Rick\Basqet\BasqetClient;

class BasqetController extends Controller
{
    private $paymentGateway;
    private $virtualAccount;
    private $services;
    

    public function __construct()
    {
        $this->paymentGateway = paymentGateway('basqet');
        $this->virtualAccount = new VirtualAccount();

        $this->services = new BasqetServices();
    }

    public function process($trx)
    {
        $user = $trx->user;

        try {
            $body = [
                'amount' => amountFormat($trx->total),
                'currency' => @settings('currency')->code,
                'reference' => $trx->id,
                'description' => translate('Payment for order #:number', [
                    'number' => $trx->id,
                ]),
                'customer' => [
                    'name' => $user->getName(),
                    'email' => $user->email,
                ],
                'redirect_url' => route('payments.ipn.billway'),
                'webhook_url' => route('payments.webhooks.billway'),
                'metadata' => [
                    'transaction_id' => $trx->id,
                    'user_id' => $user->id,
                ],
            ];

            $virtual_account_data = [
                'validFor' => 900, // 15 minutes
                'callbackUrl' => "https://rick.com/", //route('payments.ipn.billway'),
                'settlementAccount' => [
                    'bankCode' =>  $this->paymentGateway->credentials->bank_code,
                    'accountNumber' => $this->paymentGateway->credentials->account_number
                ],
                'amountControl' => 'Fixed',
                'amount' => amountFormat($trx->total),// (int)($amount * 100), // Convert to kobo
                'externalReference' => 'order_' . $trx->id . '_' . time()
            ];
            // die($this->services->fetchCurrencies());
            // $result = $this->virtualAccount->createAccount($virtual_account_data);
            // \Log::info($result );

            // if (!$result['data']) {
            //     throw new \Exception($result['message']);
            // }

            // $paymentData = $result['data'];
            
            // if ($paymentData['status'] !== 'Active') {
            //     throw new \Exception($paymentData['message'] ?? 'Payment initialization failed');
            // }

            // $trx->payment_id = $virtual_account_data['amount'];
            // $trx->update();

            $data['type'] = "success";
            $data['method'] = "hosted";
            $data['data'] = $this->services->fetchCurrencies();
            $data['view'] = 'billway';
            $data['body'] = $virtual_account_data;
        } catch (\Exception $e) {
            $data['type'] = "error";
            $data['msg'] = $e->getMessage();
        }

        return json_encode($data);
    }

    public function ipn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => ['required', 'string'],
            'status' => ['required', 'string'],
            'reference' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return redirect()->route('home');
        }

        // try {
            // Verify payment with Billway API
            $result = $this->virtualAccount->verifyPayment($request->payment_id);
            \Log::info($result);
            // $result = json_decode("");
// return $result;
            if ($result['statusCode'] != 200) {
                // throw new \Exception($result['message']);
                return json_encode([
                    "message"=>$result['message'],
                    "status" => 400
                ]);
            }

            $paymentData = $result;//$result['data'];
            
            $trx = Transaction::where('payment_id', $request->payment_id)
                ->whereIn('status', [Transaction::STATUS_PAID, Transaction::STATUS_UNPAID])
                ->firstOrFail();

            $checkoutLink = route('checkout.index', hash_encode($trx->id));

            if ($trx->isPaid()) {
                $trx->user->emptyCart();

            return json_encode([
                "url"=>$checkoutLink,
                "message" => "success",
                "status" => 200
            ]); 
                // return redirect($checkoutLink);
            }

            if ($paymentData['data']['responseCode'] !== '00') {
                // toastr()->error(translate('Payment failed or pending'));

            return json_encode([
                "url"=>$checkoutLink,
                "message" => "failed",
                "status" => 400
            ]); 
                // return redirect($checkoutLink);
            }

            $trx->payer_id = $paymentData['data']['customer']['id'] ?? $request->payment_id;
            $trx->payer_email = $paymentData['data']['customer']['email'] ?? $trx->user->email;
            $trx->status = Transaction::STATUS_PAID;
            $trx->update();

            $trx->user->emptyCart();
            event(new TransactionPaid($trx));
            return json_encode([
                "url"=>$checkoutLink,
                "message" => "success",
                "status" => 200
            ]); 
            // return redirect($checkoutLink);
        // } catch (\Exception $e) {
        //     toastr()->error($e->getMessage());
        //     return redirect()->route('home');
        // }
    }

    public function webhook(Request $request)
    {
        try {
            // Verify webhook signature (implement based on Billway's webhook verification)
            $signature = $request->header('X-Billway-Signature');
            $payload = $request->getContent();
            
            // Verify webhook signature
            // if (!$this->verifyWebhookSignature($payload, $signature)) {
            //     return response('Invalid signature', 401);
            // }

            $data = $request->all();
            
            if ($data['event'] === 'payment.completed' && $data['data']['status'] === 'completed') {
                $trx = Transaction::where('payment_id', $data['data']['payment_id'])->unpaid()->first();
                
                if ($trx) {
                    $trx->payer_id = $data['data']['customer']['id'] ?? $data['data']['payment_id'];
                    $trx->payer_email = $data['data']['customer']['email'] ?? $trx->user->email;
                    $trx->status = Transaction::STATUS_PAID;
                    $trx->update();
                    event(new TransactionPaid($trx));
                }
            }

            return response('Webhook processed successfully', 200);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    private function verifyWebhookSignature($payload, $signature)
    {
        // Implement webhook signature verification based on Safe Haven's documentation
        // This is a placeholder - you'll need to implement this according to Safe Haven's webhook verification method
        $expectedSignature = hash_hmac('sha256', $payload, $this->paymentGateway->credentials->webhook_secret ?? '');
        return hash_equals($expectedSignature, $signature);
    }
}
