<?php
namespace App\Helpers\SafeHeaven;

use App\Helpers\SafeHeaven\ApiConnectionHelper;

class VirtualAccount extends ApiConnectionHelper
{

    public function createAccount($data)
    {
      $url = '/virtual-accounts';
      $response = $this->post($url, $data);
      $decodedResponse = json_decode($response,true);
      return $decodedResponse;
    }
    public function verifyPayment($id)
    {
      $url = "/virtual-accounts/$id/transaction";
      $response = $this->get($url);
      $decodedResponse = json_decode($response,true);
      return $decodedResponse;
    }

//   get
// https://api.sandbox.safehavenmfb.com/virtual-accounts/{virtualAccountId}/transaction
  
}