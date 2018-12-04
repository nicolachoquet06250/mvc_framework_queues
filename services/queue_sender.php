<?php

namespace mvc_framework\core\queues\services;


use mvc_framework\core\queues\traits\Queue;

class queue_sender {
	public function get_queue($name) {
		return Queue::instance($name, Queue::$SEND);
	}
}