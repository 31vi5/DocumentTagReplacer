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
	 * @param type $ignoreInvalidTags - if set to false, checks whether tags in the document are invalid and throws an exception
	 * @param type $tagStartDelimiter 
	 * @param type $tagEndDelimiter
	 * @return string|false path to the newly created file if succesful, otherwise false
	 */
	public static function replaceTags($originalFilePath, $tagValues, $newFilePath = null, $ignoreInvalidTags = true,  $tagStartDelimiter = '{{', $tagEndDelimiter = '}}');

	/**
	 * assures that all tags are valid, otherwise throws an exception. If the method runs without exception, the tags in document are ok
	 * @param string $originalFilePath path to file to be checked
	 * @param string $tagStartDelimiter - character sequence that marks start of the tag
	 * @param string $tagEndDelimiter - character sequence that marks end of the tag
	 * @throws InvalidTagsException
	 */
	public function checkForInvalidTags($originalFilePath, $tagStartDelimiter, $tagEndDelimiter);

}