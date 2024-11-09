<?php

use PierreMiniggio\YoutubeAPI\YoutubeAPI;

$projectDirectory = __DIR__ . DIRECTORY_SEPARATOR;
require_once $projectDirectory . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$config = require_once $projectDirectory . 'config.php';
$accessToken = $config['accessToken'];

$youtubeApi = new YoutubeAPI($accessToken);
$videoIds = $youtubeApi->getMostRecentVideoIdsForChannel('UC8mVbQptCC7h4l5Ni-83aEQ', 3);

echo json_encode($videoIds);
