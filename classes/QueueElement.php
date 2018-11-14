<?php

namespace mvc_framework\core\queues\classes;


class QueueElement {
	use \mvc_framework\core\queues\traits\QueueElement;

	public function execute() {
		echo 'this is a basic queue element ! not execute action !';
	}
}