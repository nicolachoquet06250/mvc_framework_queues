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

	/**
	 * @throws \PHPMailer\PHPMailer\Exception
	 */
	public function execute() {
		$headers = [
			'Content-type: text/html; charset=utf-8',
			'From: '.$this->from,
			'Reply-To: '.$this->from,
			'X-Mailer: PHP/' . phpversion()
		];

		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = $this->from;
		$mail->Password = '*******';
		$mail->setFrom($this->from);
		$mail->addAddress($this->to, 'Nicolas Choquet');
		$mail->Subject = $this->object;
		$mail->msgHTML($this->content);
		if (!$mail->send()) {
			echo 'Mailer Error: '.$mail->ErrorInfo."\n";
		}
		else {
			echo "Message sent!\n";
		}
	}
}
