<?php

namespace Core\Infra\Provider;

use Carbon\Laravel\ServiceProvider;
use Core\Domain\Contracts\VideoAdapterInterface;
use Core\Domain\Contracts\VideoGatewayInterface;
use Core\Infra\Gateway\VideoGateway;
use Core\Infra\Http\Adapter\PexelsAdapter;
use Core\Infra\Http\Client\Pexels;
use GuzzleHttp\Client;

class VideoProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Pexels::class, fn () => new Pexels(
            new Client([
                'base_uri' => config('services.pexels.base_uri'),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => config('services.pexels.api_key'),
                ],
            ]),
        ));

        $this->app->bind(VideoAdapterInterface::class, PexelsAdapter::class);
        $this->app->bind(VideoGatewayInterface::class, VideoGateway::class);
    }
}
