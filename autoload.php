<?php

require_once __DIR__.'/traits/FileSystemGestion.php';
require_once __DIR__.'/traits/QueueElement.php';
require_once __DIR__.'/traits/Queue.php';

require_once __DIR__.'/classes/QueueElement.php';
require_once __DIR__.'/classes/QueueReceiver.php';
require_once __DIR__.'/classes/QueueSender.php';

require_once __DIR__.'/services/queue_receiver.php';
require_once __DIR__.'/services/queue_sender.php';

require_once __DIR__.'/ModuleLoader.php';