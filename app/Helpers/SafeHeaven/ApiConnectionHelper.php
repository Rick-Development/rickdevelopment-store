<?php
namespace App\Helpers\SafeHeaven;
use Illuminate\Support\Facades\Log;

class ApiConnectionHelper{

    private $apiClientId;
    private $apiClientAssertion;
    private $apiUrl;
    private $apiAuthUrl;

    public function __construct() {
        $this->apiClientId = config('services.safeHeaven.client_id'); // Load from config
        $this->apiClientAssertion = config('services.safeHeaven.client_assertion'); // Load from config
        $this->apiAuthUrl = config('services.safeHeaven.api_url'); // Load from config
    }


public function authentication(){

    $authCrediental = [
        "grant_type" => "client_credentials",
        "client_id"=> $this->apiClientId,
        "client_assertion_type"=> "urn:ietf:params:oauth:client-assertion-type:jwt-bearer",
        "client_assertion" => $this->apiClientAssertion,
    ];

      $jsonData = json_encode($authCrediental);

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $this->apiAuthUrl."/oauth2/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $decodedResponse = json_decode($response,true);
    return $decodedResponse;

}

     
public function get($url){
    $auth = $this->authentication();
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $this->apiAuthUrl . $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer {$auth['access_token']}",
        "ClientID: {$auth['ibs_client_id']}"
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}
public function post($url, array $data) {
    $auth = $this->authentication();
    $curl = curl_init();
    
    
    // Convert the data array to JSON
    $jsonData = json_encode($data);
    \Log::info($jsonData);
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => $this->apiAuthUrl . $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => array(
             "Authorization: Bearer {$auth['access_token']}",
            "ClientID: {$auth['ibs_client_id']}",
            "Content-Type: application/json", // Set the content type to JSON
            "Content-Length: " . strlen($jsonData) // Set the content length
        ),
    ));
    
    $response = curl_exec($curl);
    // $response = json_decode( $response,true);
    
    // Log the response
    Log::info($response);
    
    curl_close($curl);

    // {"status":false,"description":"Missing information, please check the errors","errors":{"email":"The email field must contain a valid email address."}} 
    
    return $response;
}

public function patch($url,$data){

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'PATCH',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer ".$this->authentication()['access_token'],
        "ClientID :" .$this->authentication()['ibs_client_id']    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}

public function put($url,$data){

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer ".$this->authentication()['access_token'],
        "ClientID :" .$this->authentication()['ibs_client_id']    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}

}