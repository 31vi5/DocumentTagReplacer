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

//www-data or any other user needs write privileges in example directory!
$result = $replacer::replaceTags('example.docx', $tagsToReplace, 'example_replaced.docx');

if ($result) {
	echo 'Saved new file '. $result;
} else {
	echo 'Error, unable to save result';
}
