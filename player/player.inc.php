<?php 
require __DIR__ . '\/../vendor/autoload.php';

$api = \AzuraCast\Api\Client::create(
	'172.18.58.14:81',
	'898d8c7d5b5ff3ce:8ea2787b60033b64b736e0deb9e47b9d'
);

$stationId = 1;
$nowPlaying = $api->station($stationId)->nowPlaying();
$s_tatus = $api->station($stationId)->status();
$djs = $api->station($stationId)->streamers()->list();

