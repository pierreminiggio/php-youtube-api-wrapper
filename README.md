# php-youtube-api-wrapper

Install using composer :
```console
composer require pierreminiggio/youtube-api-wrapper
```

```php
use PierreMiniggio\YoutubeAPI\YoutubeAPI;

$youtubeApi = new YoutubeAPI('yourAccessToken');

$videoIds = $youtubeApi->getMostRecentVideoIdsForChannel('yourChannelId', 10);
// or
$video = $youtubeApi->getVideoDetails('yourVideoId');
```
