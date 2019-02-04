<?php

namespace mvc_framework\core\queues\queues_classes;

use mvc_framework\core\queues\classes\QueueElement;
use PHPMailer\PHPMailer\PHPMailer;

class EmailElement extends QueueElement {
	protected $to, $from, $content, $object;
	public function __construct($element) {
		parent::__construct($element);
		$this->to = $this->get('to');
		$this->from = $this->get('from');
		$this->content = $this->get('content');
		$this->object = $this->get('object');
	}

	public function execute() {
		echo "Message sent! (not realy) \n";
	}
}
