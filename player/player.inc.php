<?php 
require __DIR__ . '\/../vendor/autoload.php';

$api = \AzuraCast\Api\Client::create(
	'https://radio.josephlariosa.com',
	'f18365945c60e2af:3ed3f229cffd450c73260f6274db0890'
);

$stationId = 1;
$nowPlaying = $api->station($stationId)->nowPlaying();
$s_tatus = $api->station($stationId)->status();
$djs = $api->station($stationId)->streamers()->list();

