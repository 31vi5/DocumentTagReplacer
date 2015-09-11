<?php

namespace DocumentTagReplacer\Exception;

/**
 * Thrown when creating a new document tag replacer for an unsupported fle type
 *
 * @author 31vi5
 */
class UnsupportedFileTypeException extends DocumentReplacerException {

	protected $code = 400;

	public function __construct() {
		$message = 'Unsupported file type';
		parent::__construct($message);
	}

}
