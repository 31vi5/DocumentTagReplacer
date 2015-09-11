<?php

namespace DocumentTagReplacer\Exception;

/**
 * Thrown when creating a new document tag replacer for an unsupported fle type
 *
 * @author 31vi5
 */
class DocumentReplacerException extends \Exception {

	protected $errorDetails;

	protected $code = 500;

	public function __construct($message = 'Unknown error') {
		parent::__construct($message, $this->code);
	}

	public function getErrorDetails() {
		return $this->errorDetails;
	}
}
