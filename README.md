# php-youtube-api-wrapper

Install using composer :
```console
composer require pierreminiggio/youtube-api-wrapper
```

```php
use PierreMiniggio\YoutubeAPI\YoutubeAPI;

$provider = new YoutubeAPI();
$accessToken = $provider->get('yourClientId', 'yourClientSecret', 'yourRefreshToken');
```
