<?php

namespace DocumentTagReplacer\Exception;

/**
 * Thrown when creating a new document tag replacer for an unsupported fle type
 * array of invalid tags is accessible via $this->errorDetails
 *
 * @author 31vi5
 */
class InvalidTagsException extends DocumentReplacerException {

	protected $code = 400;

	public function __construct($invalidTags = []) {
		$this->errorDetails = $invalidTags;

		$message = 'Document contains invalid tags';
		if (!empty($invalidTags)) {
			$message .= ': ' . implode(',', $invalidTags);
		}

		parent::__construct($message);
	}

}
