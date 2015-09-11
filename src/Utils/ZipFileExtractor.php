<?php

namespace DocumentTagReplacer\Utils;

/**
 * Extracts contents of a zip based file
 */
class ZipFileExtractor {

	public static function extractFileContentsFromZip($zipPath, $fileName) {
		$zip = new \ZipArchive;
		$data = false;

		if ($zip->open($zipPath) === true) {
			$index = $zip->locateName($fileName);
			if ($index !== false) {
				//get data from the file
				$data = $zip->getFromIndex($index);
			}
			$zip->close();
		}

		return $data;
	}
}
