<?php

declare(strict_types=1);

namespace Core\Application\UseCase;

use Core\Domain\Contracts\VideoGatewayInterface;

class SearchVideo
{
    public function __construct(
        private readonly VideoGatewayInterface $gateway
    ) {
    }

    public function search(array $data): array
    {
        return $this->gateway->searchVideo($data);
    }

    public function searchById(int $id): array
    {
        return $this->gateway->searchVideoById($id);
    }
}
