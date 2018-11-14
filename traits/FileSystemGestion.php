<?php

namespace mvc_framework\core\queues\traits;


trait FileSystemGestion {
	protected function create_directory($path, $recursive = true) {
		return mkdir($path, 0777, $recursive);
	}

	protected function remove_directory($path) {
		return rmdir($path);
	}

	protected function create_void_file($path, $file_name) {
		return touch($path.'/'.$file_name);
	}

	protected function remove_file($path, $file_name) {
		return @unlink($path.'/'.$file_name);
	}

	protected function create_file_with_content($path, $file_name, $content) {
		return file_put_contents($path.'/'.$file_name, $content);
	}

	protected function get_dirs($path) {
		$dirs = [];
		if($dir = opendir($path)) {
			while (($directory = readdir($dir)) !== false) {
				if($directory !== '.' && $directory !== '..') {
					if(is_dir($path.'/'.$directory)) {
						$dirs[] = $directory;
					}
				}
			}
		}
		return $dirs;
	}

	protected function get_files($path) {
		$files = [];
		if($dir = opendir($path)) {
			while (($file = readdir($dir)) !== false) {
				if($file !== '.' && $file !== '..') {
					if(is_dir($path.'/'.$file)) {
						$files[] = $file;
					}
				}
			}
		}
		return $files;
	}

	protected function is_directory($path) {
		return is_dir($path);
	}

	protected function is_file($path) {
		return is_file($path);
	}
}