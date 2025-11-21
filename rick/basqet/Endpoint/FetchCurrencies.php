<?php

namespace Rick\Basqet\Endpoint;

class FetchCurrencies extends AbstractEndpoint
{
    const RESOURCE = 'currency';

    public function getResource(): string
    {
        return self::RESOURCE;
    }

    public function get(): array
    {
        return $this->request(parent::METHOD_GET);
    }
}

