<?php

namespace Rick\Basqet\Endpoint;

class VerifyTransaction extends AbstractEndpoint
{
    const RESOURCE = 'transaction/{transaction_id}/status';

    public function getResource(): string
    {
        return self::RESOURCE;
    }

    public function get(): array
    {
        return $this->request(parent::METHOD_POST);
    }
}

