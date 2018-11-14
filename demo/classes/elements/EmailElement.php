<?php

namespace mvc_framework\core\queues\queues_classes;


use mvc_framework\core\queues\traits\QueueElement;

class EmailElement {
	use QueueElement;
	public function execute() {
		var_dump($this->get('email'));
		var_dump($this->get('objet'));
		var_dump($this->get('content'));
	}
}