<?php

use PierreMiniggio\YoutubeAPI\YoutubeAPI;

$projectDirectory = __DIR__ . DIRECTORY_SEPARATOR;
require_once $projectDirectory . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$config = require_once $projectDirectory . 'config.php';
$accessToken = $config['accessToken'];

$youtubeApi = new YoutubeAPI($accessToken);
$video = $youtubeApi->getVideoDetails('fkzSdQQX7T4');

var_dump($video);
