<?php

use mvc_framework\core\queues\traits\Queue;

require_once __DIR__.'/autoload.php';

$queue_email_sender = \mvc_framework\core\queues\traits\Queue::instance('email', Queue::$SEND);
$queue_email_sender->send(
	[
		'email' => 'nicolachoquet06250@gmail.com',
		'objet' => 'Salutation',
		'content' => 'hey toi tu vas bien ?'
	]
);

$queue_email_sender->send(
	[
		'email' => 'nicolachoquet06250@gmail.com',
		'objet' => 'Salutation 2',
		'content' => 'hey toi tu vas bien ?'
	]
);

$queue_email_sender->send(
	[
		'email' => 'nicolachoquet06250@gmail.com',
		'objet' => 'Salutation 3',
		'content' => 'hey toi tu vas bien ?'
	]
);

$queue_email_sender->send(
	[
		'email' => 'nicolachoquet06250@gmail.com',
		'objet' => 'Salutation 4',
		'content' => 'hey toi tu vas bien ?'
	]
);