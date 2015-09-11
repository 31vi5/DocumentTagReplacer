<?php

require __DIR__ . '/../vendor/autoload.php';

use \DocumentTagReplacer\DocumentTagReplacerFactory;
use \DocumentTagReplacer\Exception\DocumentReplacerException;

$tagsToReplace = [
	'{{tag1}}' => 'Replace 1',
	'{{tag2}}' => 'Replace 2',
	'{{tag3}}' => 'Replace 3',
];

$tagStartDelimiter = '{{';
$tagEndDelimiter = '}}';

$originalFile = 'example.docx';
$replacedFile = preg_replace('/\.docx/', '_replaced.docx', $originalFile);
try {
	/** @var $replacer DocumentTagReplacerInterface  */
	$replacer = DocumentTagReplacerFactory::getReplacer(DocumentTagReplacerFactory::TYPE_WORD);

	//www-data or any other user needs write privileges in example directory!
	$result = $replacer::replaceTags($originalFile, $tagsToReplace, $replacedFile, false, $tagStartDelimiter, $tagEndDelimiter);
} catch (DocumentReplacerException $e) {
	$trace = $e->getTraceAsString();
	$err = $e->getMessage();
	$result = false;
} catch (Exception $e) {
	//general exceptions
	$trace = $e->getTraceAsString();
	$err = $e->getMessage();
	$result = false;
}

echo '<pre>';
echo date('Y-m-d H:i:s');
echo PHP_EOL;
if ($result) {
	echo 'Saved new file ' . $result;
} else {
	echo 'Error, unable to save result: ' . $err . PHP_EOL . PHP_EOL . $trace;
}
echo '</pre>';

