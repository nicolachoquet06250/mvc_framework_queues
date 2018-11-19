<?php

namespace mvc_framework\core\queues\queues_classes;

use mvc_framework\core\queues\classes\QueueElement;

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
		$headers = [
			'Content-type: text/html; charset=utf-8',
			'From: '.$this->from,
			'Reply-To: '.$this->from,
			'X-Mailer: PHP/' . phpversion()
		];

		$sended = mail(
			$this->to,
			$this->object,
			str_replace("\n", '<br>', $this->content),
			implode("\r\n", $headers)
		);

		if($sended) echo 'success';
		else echo 'error';
	}
}