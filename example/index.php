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

?>
<a href="<?= $auth->getAuthUrl(); ?>">Login</a>