<?php

require_once __DIR__.'/autoload.php';

class receiver extends Runable {
	private static $instance;
	public static function create() {
		if(is_null(self::$instance)) self::$instance = new receiver();
		return self::$instance;
	}

	protected function start() {
		$queue_email_receiver = $this->loader->get_service_queue_receiver()->get_queue('email');
		$queue_email_receiver->run();
	}
}

receiver::create()->run();