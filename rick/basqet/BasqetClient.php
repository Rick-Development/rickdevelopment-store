<?php

namespace Rick\Basqet;


class BasqetClient
{
    const API_ENDPOINT = 'https://api.basqet.com/';

    const API_VERSION = 'v1';

    private $apiKey;

    private $testModus;

    public function __construct(string $apiKey, bool $testModus = false)
    {
        $this->apiKey = $apiKey;
        $this->testModus = $testModus;

        $this->initializeEndpoints();
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getApiEndpoint(): string
    {
        // if ($this->testModus) {
        //     return self::API_SANDBOX_ENDPOINT;
        // }

        return self::API_ENDPOINT;
    }

    private function initializeEndpoints()
    {
        // $this->status = new Endpoint\Status($this);
        $this->currency = new Endpoint\FetchCurrencies($this);
        $this->payment = new Endpoint\InitializeTransaction($this);
        $this->estimate = new Endpoint\InitiateTransaction($this);
        $this->invoice = new Endpoint\VerifyTransaction($this);
        // $this->minAmount = new Endpoint\MinAmount($this);
    }
}
