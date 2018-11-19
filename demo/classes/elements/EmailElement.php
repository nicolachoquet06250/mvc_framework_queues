<?php

namespace mvc_framework\core\queues\queues_classes;


use mvc_framework\core\queues\traits\QueueElement;

class EmailElement {
	use QueueElement;
	private $to, $from, $content, $object;
	public function __construct($element) {
		parent::__construct($element);
		$this->to = $this->get('to');
		$this->from = $this->get('from');
		$this->content = $this->get('content');
		$this->object = $this->get('object');
	}

	public function execute() {
		$headers = [
			'From' => $this->from,
			'Reply-To' => $this->from,
			'X-Mailer' => 'PHP/' . phpversion()
		];

		mail($this->to, $this->object, str_replace("\n", '<br>', $this->content), $headers);
	}
}