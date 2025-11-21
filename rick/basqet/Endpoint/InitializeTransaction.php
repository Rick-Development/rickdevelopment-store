<?php

namespace Rick\Basqet\Endpoint;

class InitializeTransaction extends AbstractEndpoint
{
    const RESOURCE = 'transaction';

    public function getResource(): string
    {
        return self::RESOURCE;
    }

    public function create(array $data): array
    {
        return $this->request(parent::METHOD_POST, null, $data);
    }
}

