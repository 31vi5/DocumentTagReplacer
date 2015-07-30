<?php

namespace DocumentTagReplacer\Exception;

/**
 * Thrown when creating a new document tag replacer for an unsupported fle type
 *
 * @author 31vi5
 */
class UnsupportedFileTypeException extends \Exception {

	public function __construct() {
		$message = 'Unsupported file type';
		$code = 400;
		parent::__construct($message, $code);
	}

}
