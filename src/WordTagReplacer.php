<?php

namespace DocumentTagReplacer;

use DocumentTagReplacer\Utils\ZipFileExtractor;
use DocumentTagReplacer\Exception\InvalidTagsException;
use DocumentTagReplacer\Exception\FileNotFoundException;

/**
 * Handles simple tag replacement in a document
 *
 * @author 31vi5
 */
class WordTagReplacer implements DocumentTagReplacerInterface {

	/**
	 * {@inheritdoc }
	 */
	public static function replaceTags($originalFilePath, $tagValues, $newFilePath = null, $ignoreInvalidTags = true, $tagStartDelimiter = '{{', $tagEndDelimiter = '}}') {
		if (is_null($newFilePath)) {
			$newFilePath = tempnam(sys_get_temp_dir(), uniqid());
		}

		if (!$ignoreInvalidTags && !empty($tagStartDelimiter) && !empty($tagEndDelimiter)) {
			self::checkForInvalidTags($originalFilePath, $tagStartDelimiter, $tagEndDelimiter);
		}

		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		$document = $phpWord->loadTemplate($originalFilePath);

		foreach ($tagValues as $tag => $value) {
			$document->setValue($tag, htmlspecialchars($value));
		}

		$document->saveAs($newFilePath);

		//if it failed for some reason, return false
		if (!file_exists($newFilePath)) {
			$newFilePath = false;
		}

		return $newFilePath;
	}

	/**
	 *
	 * @param type $originalFilePath
	 * @param type $tagStartDelimiter
	 * @param type $tagEndDelimiter
	 * @return boolean
	 * @throws FileNotFoundException
	 * @throws InvalidTagsException
	 */
	public function checkForInvalidTags($originalFilePath, $tagStartDelimiter, $tagEndDelimiter) {
		//verify existence
		if (!file_exists($originalFilePath)) {
			throw new FileNotFoundException($originalFilePath);
		}

		//get file contents from zip
		$wordDocumentXml = ZipFileExtractor::extractFileContentsFromZip($originalFilePath, 'word/document.xml');

		//match everything from start delimiter to the end delimiter - tags, but possibly with invalid xml in them
		$pattern = '/'.preg_quote($tagStartDelimiter) .'((?!'.preg_quote($tagStartDelimiter).').)+?(?='.preg_quote($tagEndDelimiter).')' . preg_quote($tagEndDelimiter).'/';
		$matchedTags = [];
		preg_match_all($pattern, $wordDocumentXml, $matchedTags);

		//compare found values with values stripped of XML tags - if they differ, the tags are invalid
		$invalidTags = [];
		foreach ($matchedTags[0] as $match) {
			$originalLength = strlen($match);
			$strippedTag = strip_tags($match);
			$strippedLength = strlen($strippedTag);

			if ($originalLength > $strippedLength) {
				//the tag is invalid
				$invalidTags[] = $strippedTag;
			}
		}

		if (!empty($invalidTags)) {
			//throw exception for invalid tags
			throw new InvalidTagsException($invalidTags);
		}

		return true;
	}

}
