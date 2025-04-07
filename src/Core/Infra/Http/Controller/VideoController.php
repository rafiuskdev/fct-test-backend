<?php

namespace Core\Infra\Http\Controller;

use App\Http\Controllers\Controller;
use Core\Application\UseCase\SearchVideo;
use Core\Infra\Http\Request\VideoRequest;
use Illuminate\Http\JsonResponse;

class VideoController extends Controller
{
    public function __construct(
        private readonly SearchVideo $video,
    ) {
    }

    public function search(VideoRequest $request): JsonResponse
    {
        $response = $this->video->search($request->validated());

        return $this->formatResponse($response);
    }

    public function searchById(int $id): JsonResponse
    {
        $response = $this->video->searchById($id);

        return $this->formatResponse($response, true);
    }

    private function formatResponse(array $response, bool $isSingle = false): JsonResponse
    {
        $formatVideo = function ($video) {
            return [
                'width' => $video['width'],
                'height' => $video['height'],
                'duration' => $video['duration'],
                'user_name' => $video['user']['name'],
                'video_files' => $video['video_files'],
                'Video_pictures' => $video['video_pictures'],
                'id' => $video['id'],
            ];
        };

        if ($isSingle) {
            return response()->json([
                'items' => [$formatVideo($response)]
            ]);
        }

        $formattedVideos = array_map($formatVideo, $response['videos']);
        $totalPages = ceil($response['total_results'] / $response['per_page']);

        return response()->json([
            'items' => $formattedVideos,
            'page' => (int) $response['page'],
            'per_page' => (int) $response['per_page'],
            'total_pages' => $totalPages,
        ]);
    }
}
