<?php

namespace mvc_framework\core\queues\classes;

use mvc_framework\core\queues\traits\Queue;

class QueueSender {
	use Queue;

	/**
	 * @param object|array|string $element
	 * @param string|callable $successCallback
	 * @param null|string|callable $errorCallback
	 */
	public function enqueue($element, $successCallback = null, $errorCallback = null) {
		if(isset($element[0])) {
			foreach ($element as $elem) {
				if($this->add_element_to_queue($elem))
					if(!is_null($successCallback)) $successCallback($elem);
				elseif (!is_null($errorCallback)) $errorCallback($elem);
			}
		}
		else {
			if($this->add_element_to_queue($element))
				if(!is_null($successCallback)) $successCallback($element);
			elseif (!is_null($errorCallback)) $errorCallback($element);
		}
	}
}