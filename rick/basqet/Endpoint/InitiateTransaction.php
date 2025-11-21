<?php

namespace Rick\Basqet\Endpoint;

class InitiateTransaction extends AbstractEndpoint
{
    const RESOURCE = "transaction/\$transaction_id/pay";

  
    public function getResource(): string
    {
        return self::RESOURCE;
    }

    public function create(array $data): array
    {
        return $this->request(parent::METHOD_POST, null, $data);
    }
}


