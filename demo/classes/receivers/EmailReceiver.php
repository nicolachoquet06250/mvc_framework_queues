<?php

namespace mvc_framework\core\queues\queues_classes;

use mvc_framework\core\queues\classes\QueueReceiver;

class EmailReceiver extends QueueReceiver {
	public static function run_callback(EmailReceiver $queue, EmailElement $current_element) {
		$current_element->execute();
	}

	/**
	 * @inheritdoc
	 */
	public function run($callback = null) {
		$callback = !is_null($callback) ? $callback : __CLASS__.'::run_callback';
		parent::run($callback);
	}
}