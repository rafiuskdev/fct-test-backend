<?php

declare(strict_types=1);

namespace Core\Infra\Gateway;

use Core\Domain\Contracts\VideoAdapterInterface;
use Core\Domain\Contracts\VideoGatewayInterface;

readonly class VideoGateway implements VideoGatewayInterface
{
    public function __construct(
      private VideoAdapterInterface $adapter
    ) {
    }

    public function searchVideo(array $filter): array
    {
        return $this->adapter->searchVideos($filter);
    }

    public function searchVideoById(int $id): array
    {
        return $this->adapter->searchVideoById($id);
    }
}
