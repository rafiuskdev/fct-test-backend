<?php

declare(strict_types=1);

namespace Core\Domain\Contracts;

interface VideoAdapterInterface
{
    public function searchVideos(array $data): array;
    public function searchVideoById(int $id): array;
}
