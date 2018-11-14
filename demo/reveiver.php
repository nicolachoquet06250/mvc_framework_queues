<?php

use mvc_framework\core\queues\traits\Queue;

require_once __DIR__.'/autoload.php';

$queue_email_receiver = \mvc_framework\core\queues\traits\Queue::instance('email', Queue::$RECEIVE);
$queue_email_receiver->run();