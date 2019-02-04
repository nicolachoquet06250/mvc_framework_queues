<?php

namespace mvc_framework\core\queues\classes;

use mvc_framework\core\queues\traits\Queue;

class QueueReceiver {
	use Queue;
	protected $element_except_path = __DIR__.'/../classes';
	public $element_path = __DIR__.'/../demo/classes/elements';

	protected function get_callback($callback) {
		return !is_null($callback) ? $callback : get_class($this).'::run_callback';
	}

	protected function get_array_content() {
		$queue_json = json_decode(file_get_contents(Queue::$QUEUES_PATH.'/'.$this->queue_file));
		return $queue_json;
	}

	protected function get_last_id_of_array_content() {
		$array = $this->get_array_content();
		return $array[count($array)-1];
	}

	/**
	 * @param null|callable|string $callback
	 */
	public function run($callback = null) {
		echo 'La queue `'.$this->name.'` est lancée !'."\n";
		if($this->locked()) $this->unlock();
		while (true) {
			if(!$this->locked()) {
				if(!$this->is_empty()) {
					$this->lock();
					$class = ucfirst($this->name).'Element';
					$element_name = Queue::$NAMESPACE.$class;
					if(!$this->is_file(Queue::$ELEMENTS_PATH.'/'.$class.'.php')) {
						$class = 'QueueElement';
						$element_name = '\mvc_framework\core\queues\classes\\'.$class;
						require_once $this->element_except_path.'/'.$class.'.php';
					}
					elseif (!class_exists($class)) {
						require_once Queue::$ELEMENTS_PATH.'/'.$class.'.php';
					}
					$array_content = $this->get_array_content()[0];
					$callback($this, new $element_name($array_content));
					$this->take_out_first_element_to_queue();
					$this->unlock();
				}
			}
		}
	}
}