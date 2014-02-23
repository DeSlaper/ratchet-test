<?php
use Ratchet\Server\IoServer;
use MyApp\Chat;

require realpath(dirname(__DIR__)).'/vendor/autoload.php';

$server = IoServer::factory(
	new Chat(),
	8080
);

$server->run();