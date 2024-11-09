<?php

namespace PierreMiniggio\YoutubeAPI;

use CurlHandle;

class YoutubeAPI
{

    public function __construct(private string $accessToken)
    {
    }

    /**
     * @throws YoutubeAPI
     * 
     * @return array<string>
     */
    public function getMostRecentVideoIdsForChannel(string $channelId, int $maxResults): array
    {
        $curl = curl_init('https://www.googleapis.com/youtube/v3/search?channelId=' . $channelId . '&part=id&order=date&maxResults=' . $maxResults);

        curl_setopt_array($curl, $this->getCurlOptions());

        $jsonResponse = $this->executeCurl($curl);

        $videoIds = array_filter(array_map(
            fn ($jsonResponseItem) => $jsonResponseItem['id']['videoId'] ?? null,
            $jsonResponse['items']
        ), fn ($channelVideoId) => $channelVideoId !== null);

        return $videoIds;
    }

    public function getVideoDetails(string $videoId): YoutubeVideo
    {
        $curl = curl_init('https://www.googleapis.com/youtube/v3/videos?id=' . $videoId . '&part=snippet');
        curl_setopt_array($curl, $this->getCurlOptions());

        $jsonResponse = $this->executeCurl($curl);

        $snippet = $jsonResponse['items'][0]['snippet'];
        $youtubeVideo = new YoutubeVideo(
            $snippet['channelId'],
            $videoId,
            'https://www.youtube.com/watch?v=' . $videoId,
            $snippet['thumbnails']['high']['url'],
            $snippet['title'],
            $snippet['description'],
            $snippet['tags'] ?? []
        );

        return $youtubeVideo;
    }

    protected function executeCurl(CurlHandle $curl): array
    {
        $curlResult = curl_exec($curl);

        if ($curlResult === false) {
            $curlError = curl_error($curl);

            throw new YoutubeAPIException($curlError);
        }

        $jsonResponse = json_decode($curlResult, true);

        if (! empty($jsonResponse['error'])) {
            $this->handleError($jsonResponse);
        }

        return $jsonResponse;
    }

    /**
     * @return array<string, mixed>
     */
    protected function getCurlOptions(): array
    {
        return [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->accessToken
            ]
        ];
    }

    /**
     * @throws YoutubeAPIException
     */
    protected function handleError(array $jsonResponse): void
    {
        $error = $jsonResponse['error'];

        if (is_array($error)) {
            $apiError = 'Error ' . $error['code'] . ': ' . $error['message'];
        } else {
            $apiError = $error;

            if (! empty($jsonResponse['error_description'])) {
                $apiError .= ' - ' . $jsonResponse['error_description'];
            }
        }

        throw new YoutubeAPIException($apiError);
    }
}
