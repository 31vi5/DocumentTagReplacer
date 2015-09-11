<?php

namespace DocumentTagReplacer\Exception;

/**
 * Thrown when creating a new document tag replacer for an unsupported fle type
 *
 * @author 31vi5
 */
class FileNotFoundException extends \DocumentReplacerException {

	protected $code = 400;

	public function __construct($path) {
		$message = sprintf('The requested file %s was not found on the server', $path);
		parent::__construct($message);
	}

}
