<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Twitch\Twitch;
use Twitch\TwitchConfig;

$config = new TwitchConfig(
	'CLIENT_ID',
	'CLIENT_SECRET',
	'RETURN_URI'
);
$twitch = new Twitch($config);
$auth = $twitch->getAuthApi();

try {
	$token = $auth->getUserToken();

	var_dump($token);
} catch (Exception $e) {
	echo $e->getMessage();
}
