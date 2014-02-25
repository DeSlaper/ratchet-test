<?php
error_reporting(E_ALL);
$data = [
	'id'   => uniqid(),
	'user' => rand(1,30),
	'cat'  => $_POST['cat'],
	'post' => $_POST['msg'],
];
// var_dump($data); die;
$context = new ZMQContext();
var_dump($context);
$socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
var_dump($socket);
var_dump($socket->connect("tcp://192.168.3.3:5555"));

var_dump($socket->send(json_encode($data)));