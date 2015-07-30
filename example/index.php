<?php

require __DIR__ . '/../vendor/autoload.php';

use \DocumentTagReplacer\DocumentTagReplacerFactory;

/**
 * @var $replacer DocumentTagReplacerInterface
 */
$replacer = \DocumentTagReplacer\DocumentTagReplacerFactory::getReplacerInstance(DocumentTagReplacerFactory::TYPE_WORD);

$tagsToReplace = [
	'{{tag1}}' => 'Replace 1',
	'{{tag2}}' => 'Replace 2',
	'{{tag3}}' => 'Replace 3',
];

//www-data or any other user needs write privileges in example directory!
$replacer::replaceTags(__DIR__.DIRECTORY_SEPARATOR.'example.docx', $tagsToReplace, __DIR__.DIRECTORY_SEPARATOR.'example_replaced.docx');
