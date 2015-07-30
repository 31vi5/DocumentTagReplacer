<?php

namespace DocumentTagReplacer;

/**
 * Defines set of methods that need to be implemented by MS Word classes that replace tags in a document
 */
interface DocumentTagReplacerInterface {

	/**
	 * replaces all occurencies of tags in a given MS Word document template file and returns path to the newly
	 * created file in which all tags are replaced. The original file remains unchanged
	 * @param string $originalFilePath absolute path to the original file
	 * @param array $tagValues
	 * {{{
	 *	array(
	 *		'{{tag1}}' => 'value1',
	 *		'{{tag2}}' => 'value2'
	 *	)
	 * }}}
	 * @param string $newFilePath optional if specified, the new file is created in the given location, otherwise, the file is created in the system's temp folder
	 * @return string|false path to the newly created file if succesful, otherwise false
	 */
	public static function replaceTags($originalFilePath, $tagValues, $newFilePath = null);

}