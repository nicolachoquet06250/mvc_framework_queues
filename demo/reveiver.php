<?php

use mvc_framework\core\queues\traits\Queue;

require_once __DIR__.'/autoload.php';

$queue_email = \mvc_framework\core\queues\traits\Queue::instance('email', Queue::$RECEIVE);
$queue_email->run();