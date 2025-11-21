<?php
namespace App\Helpers\SafeHeaven;

use App\Helpers\SafeHeaven\ApiConnectionHelper;   


class TransferHelper extends ApiConnectionHelper{
    
    public function bankList(){
        $url = '/transfers/banks';
        $response = $this->get($url);
        $decodedResponse = json_decode($response,true);
        return $decodedResponse;
    }  

    public function nameEnquiry($data){
        $url = '/transfers/name-enquiry';
        $response = $this->post($url, $data);
        $decodedResponse = json_decode($response,true);
        return $decodedResponse;
    }  

    public function transfer($data){
        $url = '/transfers';
        $response = $this->post($url, $data);
        $decodedResponse = json_decode($response,true);
        return $decodedResponse;
    }
    public function transferStatus($data){
        $url = '/transfers/status';
        $response = $this->post($url, $data);
        $decodedResponse = json_decode($response,true);
        return $decodedResponse;
    }
    public function getTransfer($data){
        $url = '/transfers/'.$data['accountId'];
        $response = $this->get($url);
        $decodedResponse = json_decode($response,true);
        return $decodedResponse;
    }

    

}