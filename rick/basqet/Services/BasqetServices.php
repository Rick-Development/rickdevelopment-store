<?php

namespace Rick\Basqet\Services;

use Rick\Basqet\Endpoint\AbstractEndpoint;
use Rick\Basqet\BasqetClient;


class BasqetServices
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    protected $client;

    public function __construct()
    {
        $this->client = new BasqetClient(env('BASQET_API_KEY'), false);

    }

    public function fetchCurrencies(): array
    {
        $endpoint = new \Rick\Basqet\Endpoint\FetchCurrencies($this->client);
        return $endpoint->get();
    }




}
