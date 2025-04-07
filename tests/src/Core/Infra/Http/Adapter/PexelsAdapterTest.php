<?php

namespace Tests\src\Core\Infra\Http\Adapter;

use Core\Domain\Contracts\VideoAdapterInterface;
use Core\Infra\Http\Adapter\PexelsAdapter;
use Core\Infra\Http\Client\Pexels;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery;
use PHPUnit\Framework\TestCase;

class PexelsAdapterTest extends TestCase
{
    private PexelsAdapter $adapter;
    private Pexels $pexels;
    private Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = Mockery::mock(Client::class);
        $this->pexels = Mockery::mock(Pexels::class);
        $this->pexels->shouldReceive('getClient')->andReturn($this->client);

        $this->adapter = new PexelsAdapter($this->pexels);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testSearchVideosWithRegularSearch(): void
    {
        $data = [
            'query' => 'nature',
            'per_page' => 10,
            'page' => 1,
            'locale' => 'en-US',
            'size' => 'large',
            'is_popular' => false
        ];

        $expectedParams = [
            'query' => [
                'query' => 'nature',
                'per_page' => 10,
                'page' => 1,
                'locale' => 'en-US',
                'size' => 'large'
            ]
        ];

        $responseBody = json_encode(['videos' => [['id' => 1, 'title' => 'Nature Video']]]);
        $response = new Response(200, [], $responseBody);

        $this->client
            ->shouldReceive('request')
            ->once()
            ->with('GET', '/videos/search', $expectedParams)
            ->andReturn($response);

        $result = $this->adapter->searchVideos($data);

        $this->assertEquals(['videos' => [['id' => 1, 'title' => 'Nature Video']]], $result);
    }

    public function testSearchVideosWithPopularSearch(): void
    {
        $data = [
            'query' => 'nature',
            'per_page' => 10,
            'page' => 1,
            'is_popular' => true
        ];

        $expectedParams = [
            'query' => [
                'query' => 'nature',
                'per_page' => 10,
                'page' => 1,
                'locale' => null,
                'size' => null
            ]
        ];

        $responseBody = json_encode(['videos' => [['id' => 2, 'title' => 'Popular Nature']]]);
        $response = new Response(200, [], $responseBody);

        $this->client
            ->shouldReceive('request')
            ->once()
            ->with('GET', '/videos/popular', $expectedParams)
            ->andReturn($response);

        $result = $this->adapter->searchVideos($data);

        $this->assertEquals(['videos' => [['id' => 2, 'title' => 'Popular Nature']]], $result);
    }

    public function testSearchVideoById(): void
    {
        $videoId = 12345;
        $responseBody = json_encode(['id' => 12345, 'title' => 'Test Video']);
        $response = new Response(200, [], $responseBody);

        $this->client
            ->shouldReceive('request')
            ->once()
            ->with('GET', '/videos/videos/' . $videoId)
            ->andReturn($response);

        $result = $this->adapter->searchVideoById($videoId);

        $this->assertEquals(['id' => 12345, 'title' => 'Test Video'], $result);
    }
}
