<?php

namespace mvc_framework\core\queues\traits;


use mvc_framework\core\queues\classes\QueueReceiver;
use mvc_framework\core\queues\classes\QueueSender;

trait Queue {
	use FileSystemGestion;
	private static $instance = [];
	private $name, $queues_path, $queue_file, $lock_file;
	private static $actions = [
		'receive' 	=> 'Receiver',
		'recevoir' 	=> 'Receiver',
		'send' 		=> 'Sender',
		'envoyer' 	=> 'Sender'
	];

	public static $RECEIVE 	= 'receive';
	public static $SEND 	= 'send';

	public function __construct($name) {
		$this->name = $name;
		$this->queues_path = __DIR__.'/../queues';
		$this->queue_file = $this->name.'Queue.json';
		$this->lock_file = $this->name.'Queue.lock';

		$this->create_queues_repo();
		$this->create_queue_file();
	}

	protected function create_queues_repo() {
		if(!$this->is_directory($this->queues_path))
			$this->create_directory($this->queues_path, true);
	}

	protected function create_queue_file() {
		if(!$this->is_file($this->queues_path.'/'.$this->queue_file)) {
			$this->create_file_with_content($this->queues_path, $this->queue_file, '[]');
		}
	}

	/**
	 * @param array|object $element
	 * @return bool
	 */
	protected function add_element_to_queue($element) {
		$queue_json = json_decode(file_get_contents($this->queues_path.'/'.$this->queue_file));
		$nb_before = count($queue_json);
		$queue_json[] = is_object($element) ? $element->toArray() : $element;
		$nb_after = count($queue_json);
		$success = $this->create_file_with_content($this->queues_path, $this->queue_file, json_encode($queue_json));
		return $success && $nb_after === $nb_before + 1;
	}

	protected function take_out_first_element_to_queue() {
		$queue_json = json_decode(file_get_contents($this->queues_path.'/'.$this->queue_file));
		$nb_before = count($queue_json);
		unset($queue_json[0]);
		$tmp = [];
		foreach ($queue_json as $item) {
			$tmp[] = $item;
		}
		$queue_json = $tmp;
		$nb_after = count($queue_json);
		$success = $this->create_file_with_content($this->queues_path, $this->queue_file, json_encode($queue_json));
		return $success && $nb_after === $nb_before - 1;
	}

	protected function locked() {
		return $this->is_file($this->queues_path.'/'.$this->lock_file);
	}

	protected function lock() {
		return $this->create_void_file($this->queues_path, $this->lock_file);
	}

	protected function unlock() {
		return $this->remove_file($this->queues_path, $this->lock_file);
	}

	protected function get_unserialized_element($i) {
		$queue_json = json_decode(file_get_contents($this->queues_path.'/'.$this->queue_file));
		return isset($queue_json[$i]) ? unserialize(json_encode($queue_json[$i])) : null;
	}

	public function is_empty() {
		$queue_json = json_decode(file_get_contents($this->queues_path.'/'.$this->queue_file));
		return empty($queue_json);
	}

	/**
	 * @param $name
	 * @param $action
	 * @return QueueReceiver|QueueSender
	 */
	public static function instance($name, $action) {
		if(in_array($action, array_keys(self::$actions))) {
			if(!isset(self::$instance[$name][$action])) {
				$class          = ucfirst($name).self::$actions[$action];
				$__ = '\mvc_framework\core\queues\queues_classes\\'.$class;
				self::$instance[$name][$action] = new $__($name);
			}
			return self::$instance[$name][$action];
		}
		return null;
	}
}