<?php

require __DIR__ . '/../vendor/autoload.php';

use \DocumentTagReplacer\DocumentTagReplacerFactory;

/**
 * @var $replacer DocumentTagReplacerInterface
 */
$replacer = DocumentTagReplacerFactory::getReplacer(DocumentTagReplacerFactory::TYPE_WORD);

$tagsToReplace = [
	'{{tag1}}' => 'Replace 1',
	'{{tag2}}' => 'Replace 2',
	'{{tag3}}' => 'Replace 3',
];

$originalFile = 'example.docx';
$replacedFile = preg_replace('/\.docx/', '_replaced.docx', $originalFile);

//www-data or any other user needs write privileges in example directory!
$result = $replacer::replaceTags($originalFile, $tagsToReplace, $replacedFile);

echo date('Y-m-d H:i:s');
echo PHP_EOL;
if ($result) {
	echo 'Saved new file '. $result;
} else {
	echo 'Error, unable to save result';
}
