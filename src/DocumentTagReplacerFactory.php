<?php


namespace DocumentTagReplacer;

use DocumentTagReplacer\WordTagReplacer;



/**
 * Creates instance of document tag replacer based on file type
 *
 * @author 31vi5
 */
class DocumentTagReplacerFactory {

	const TYPE_WORD = 1;

	/**
	 * array of supported file types
	 * @var array
	 */
	protected static $supportedTypes =  [
		self::TYPE_WORD
	];

	public static function getReplacer($type) {
		if (!self::isSupportedType($type)) {
			throw new UnsupportedFileTypeException();
		}

		switch ($type) {
			case self::TYPE_WORD:
				$class = \DocumentTagReplacer\WordTagReplacer::class;
				break;
			default:
				throw new Exception('This shouldn\'t happen');
		}

		return $class;
	}

	protected static function isSupportedType($type) {
		return in_array($type, self::$supportedTypes);
	}

}
