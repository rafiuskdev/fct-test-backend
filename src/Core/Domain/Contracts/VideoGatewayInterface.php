<?php

declare(strict_types=1);

namespace Core\Domain\Contracts;

interface VideoGatewayInterface
{
    public function searchVideo(array $filter): array;
    public function searchVideoById(int $id): array;
}
