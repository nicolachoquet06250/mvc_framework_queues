<?php

namespace mvc_framework\core\queues\traits;


trait QueueElement {
	protected static $callback_execute;
	public function __construct($element) {
		foreach ($element as $var => $value) {
			$this->$var = $value;
		}
	}

	public function get_props() {
		return array_keys(get_object_vars($this));
	}

	public function get($key) {
		return $this->has_prop($key) ? $this->$key : null;
	}

	public function get_props_values() {
		return get_object_vars($this);
	}

	public function has_prop($key) {
		return in_array($key, array_keys(get_object_vars($this)));
	}

	public static function set_callback_execute($callback_execute) {
		self::$callback_execute = $callback_execute;
	}

	public function execute() {
		$callback = self::$callback_execute;
		$callback($this);
	}
}