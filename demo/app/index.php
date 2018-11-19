<?php

use mvc_framework\core\queues\traits\Queue;

require_once __DIR__.'/../autoload.php';

header('Content-Type: application/json');

$queue_email_sender = \mvc_framework\core\queues\traits\Queue::instance('email', Queue::$SEND);
$email = [
	'to' => $_POST['to'],
	'from' => $_POST['from'],
	'content' => $_POST['content'],
	'object' => $_POST['object'],
];
$nb_envois = $_POST['nb_envois'];

$cmp = 0;
$max = intval($nb_envois);

while ($cmp < $max) {
	$queue_email_sender->send($email);
	$cmp++;
}

echo json_encode(
	[
		'success' => true,
	]
);