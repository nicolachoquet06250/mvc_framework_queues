<?php

namespace mvc_framework\core\queues;


use mvc_framework\core\queues\services\queue_receiver;
use mvc_framework\core\queues\services\queue_sender;

/**
 * Class ModuleLoader
 *
 * @package mvc_framework\core\queues
 *
 * @method queue_receiver get_service_queue_receiver()
 * @method queue_sender get_service_queue_sender()
 */
class ModuleLoader {
	protected $charged = [
		'service' => 'services',
		'tool' => 'utils',
		'model' => 'models',
		'controller' => 'controllers',
		'view' => 'views',
	];
	protected $services = [];
	protected $utils = [];
	protected $models = [];
	protected $controllers = [];
	protected $views = [];
	protected $router = [];

	public function __construct() {
		if(!is_null($this->services)) {
			$this->services = [
				'queue_receiver' => queue_receiver::class,
				'queue_sender' => queue_sender::class,
			];
		}
	}

	public function __call($name, $arguments) {
		foreach ($this->charged as $_name => $prop) {
			if(strstr($name, 'get_'.$_name.'_')) {
				if(!is_null($this->$prop)) {
					$key = str_replace('get_'.$_name.'_', '', $name);
					if(isset($this->$prop[$key])) {
						return new $this->$prop[$key]();
					}
				}
			}
		}
		return null;
	}
}