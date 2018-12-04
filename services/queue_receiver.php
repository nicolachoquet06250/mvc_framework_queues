<?php

namespace mvc_framework\core\queues\services;


use mvc_framework\core\queues\traits\Queue;

class queue_receiver {
	public function get_queue($name) {
		return Queue::instance($name, Queue::$RECEIVE);
	}
}