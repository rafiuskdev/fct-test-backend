<?php

declare(strict_types=1);

namespace Core\Infra\Http\Adapter;

use Core\Domain\Contracts\VideoAdapterInterface;
use Core\Infra\Http\Client\Pexels;

class PexelsAdapter implements VideoAdapterInterface
{
    public function __construct(
      private Pexels $pexels
    ) {
    }

    public function searchVideos(array $data): array
    {
        $params = [
            'query' => $data['query'],
            'per_page' => $data['per_page'],
            'page' => $data['page']
        ];

        $params['locale'] = $data['locale'] ?? null;

        $params['size'] = $data['size'] ?? null;

        $response = $data['is_popular']
            ? $this->pexels->getClient()->request('GET', '/videos/popular', ['query' => $params])
            : $this->pexels->getClient()->request('GET', '/videos/search', ['query' => $params]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function searchVideoById(int $id): array
    {
        $response = $this->pexels->getClient()->request('GET', '/videos/videos/' . $id);

        return json_decode($response->getBody()->getContents(), true);
    }
}
