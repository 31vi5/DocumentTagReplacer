<?php

namespace DocumentTagReplacer;

/**
 * Handles simple tag replacement in a document
 *
 * @author 31vi5
 */
class WordTagReplacer implements DocumentTagReplacerInterface {

	/**
	 * {@inheritdoc }
	 */
	public static function replaceTags($originalFilePath, $tagValues, $newFilePath = null) {
		if (is_null($newFilePath)) {
			$newFilePath = tempnam(sys_get_temp_dir(), uniqid());
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

}
