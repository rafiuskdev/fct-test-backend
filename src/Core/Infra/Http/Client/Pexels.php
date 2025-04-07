<?php

namespace Core\Infra\Http\Client;

use GuzzleHttp\Client;

class Pexels
{
    public function __construct(
        public Client $client
    ) {
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
