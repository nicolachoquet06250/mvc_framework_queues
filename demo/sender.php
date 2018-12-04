<?php

require_once __DIR__.'/autoload.php';

class sender extends Runable {
	private static $instance;
	public static function create() {
		if(is_null(self::$instance)) self::$instance = new sender();
		return self::$instance;
	}

	protected function start() {
		$queue_email_sender = $this->loader->get_service_queue_sender()->get_queue('email');
		$queue_email_sender->enqueue(
			[
				'to' => 'nicolachoquet06250@gmail.com',
				'from' => 'nicolachoquet06250@gmail.com',
				'object' => 'Salutation',
				'content' => 'hey toi tu vas bien ?'
			]
		);

		$queue_email_sender->enqueue(
			[
				'to' => 'nicolachoquet06250@gmail.com',
				'from' => 'nicolachoquet06250@gmail.com',
				'object' => 'Salutation',
				'content' => 'hey toi tu vas bien ?'
			]
		);

		$queue_email_sender->enqueue(
			[
				'to' => 'nicolachoquet06250@gmail.com',
				'from' => 'nicolachoquet06250@gmail.com',
				'object' => 'Salutation',
				'content' => 'hey toi tu vas bien ?'
			]
		);

		$queue_email_sender->enqueue(
			[
				'to' => 'nicolachoquet06250@gmail.com',
				'from' => 'nicolachoquet06250@gmail.com',
				'object' => 'Salutation',
				'content' => 'hey toi tu vas bien ?'
			]
		);
	}
}

sender::create()->run();