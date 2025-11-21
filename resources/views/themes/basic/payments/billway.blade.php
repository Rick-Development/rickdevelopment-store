@extends('themes.basic.layouts.single')
@section('noindex', true)
@section('section', translate('Checkout'))
@section('header_title', translate('Complete the payment'))
@section('title', translate('Complete the payment'))
@section('body_bg', 'bg-white')
@section('breadcrumbs', Breadcrumbs::render('checkout', $trx))
@section('header_v3', true)
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="box bg-color">
                <h6 class="fs-4 mb-4">{{ translate('Payment details') }}</h6>
                <ul class="list-group list-group-flush mb-4">
                    @if ($trx->hasTax() || $trx->hasFees())
                        <li class="list-group-item d-flex justify-content-between p-3 bg-color">
                            <strong>{{ translate('SubTotal') }}</strong>
                            <span>{{ getAmount($trx->amount) }}</span>
                        </li>
                        @if ($trx->hasTax())
                            <li class="list-group-item d-flex justify-content-between p-3 bg-color">
                                <strong>{{ translate(':tax_name (:tax_rate%)', [
                                    'tax_name' => $trx->tax->name,
                                    'tax_rate' => $trx->tax->rate,
                                ]) }}</strong>
                                <span>{{ getAmount($trx->tax->amount) }}</span>
                            </li>
                        @endif
                        @if ($trx->hasFees())
                            <li class="list-group-item d-flex justify-content-between p-3 bg-color">
                                <strong>{{ translate(':payment_gateway Fees (:percentage%)', [
                                    'payment_gateway' => $trx->paymentGateway->name,
                                    'percentage' => $trx->paymentGateway->fees,
                                ]) }}</strong>
                                <span>{{ getAmount($trx->fees) }}</span>
                            </li>
                        @endif
                    @endif
                    <li class="d-none list-group-item d-flex justify-content-between p-3 bg-color">
                        <h3 class="mb-0">{{ translate('Total') }}</h3>
                        <h3 class="mb-0">{{ getAmount($trx->total) }}</h3>
                    </li>
                </ul>

                {{--!! json_encode($data)  !!--}}

                <div>
                    <h3>Bank Transfer Details</h3>
                    <p><strong>Account Number:</strong> {{ $data->accountNumber }}</p>
                    <p><strong>Bank Name:</strong> {{ 'Safe Haven Microfinance Bank' }}</p>
                    <p><strong>Account Name:</strong> {{ $data->accountName }}</p>
                    <p><strong>Amount:</strong> {{  getAmount($data->amount) }} {{ $data->currencyCode }}</p>
                    <p><strong>Time left:</strong> <span id="countdown"></span></p>
                </div>

                <a href="{{ route('checkout.index', hash_encode($trx->id)) }}"
                    class="btn btn-outline-primary btn-md w-100 mt-3">
                    {{ translate('Cancel Payment') }}
                </a>
            </div>
        </div>
    </div>

    <script>
        // Countdown Timer
        const expiryDate = new Date("{{ $data->expiryDate }}").getTime();
        const countdownElem = document.getElementById('countdown');

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = expiryDate - now;

            if (distance < 0) {
                countdownElem.innerHTML = "Expired";
                clearInterval(countdownInterval);
                clearInterval(statusInterval);
                return;
            }

            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElem.innerHTML = minutes + "m " + seconds + "s ";
        }

        updateCountdown();
        const countdownInterval = setInterval(updateCountdown, 1000);

        var url = "{{ route('payments.ipn.billway') }}?payment_id={{ $data->_id }}&reference={{$data->externalReference}}&status=0";
        console.log('====================================');
        console.log(url);
        console.log('====================================');
        // AJAX Polling for Payment Status
        function checkPaymentStatus() {
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => response.json())
            // .then(response => {
            //     console.log('====================================');
            //     console.log(response.json()->message);
            //     console.log('====================================');
            // })
            .then(data => {
                console.log(data.message);
                if (data.status != 200) {
                    
                console.log(data.message);
                } else {
                    window.location.href = data.url;
                }
                
            })
            .catch(error => {
                // Optionally handle errors
                console.log(error);
            });
        }

        // Poll every 10 seconds
        const statusInterval = setInterval(checkPaymentStatus, 10000);
    </script>
@endsection
