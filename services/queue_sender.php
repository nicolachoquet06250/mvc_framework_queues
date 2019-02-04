<?php

namespace mvc_framework\core\queues\services;


use mvc_framework\core\queues\traits\Queue;

class queue_sender {
	/**
	 * @param $name
	 * @return \mvc_framework\core\queues\classes\QueueReceiver|\mvc_framework\core\queues\classes\QueueSender
	 * @throws \Exception
	 */
	public function get_queue($name) {
		return Queue::instance($name, Queue::$SEND);
	}
}