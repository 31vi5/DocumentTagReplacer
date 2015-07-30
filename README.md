# DocumentTagReplacer

PHP library that can replace tags in documents, currently only docx files. 

Built with PHPWord.

## Usage

Specify array of tags and corresponding values. The values are then replaced for the tags in the given document.

```php
$replacer = \DocumentTagReplacer\DocumentTagReplacerFactory::getReplacerInstance(DocumentTagReplacerFactory::TYPE_WORD);

$tagsToReplace = [
	'{{tag1}}' => 'Replace 1',
	'{{tag2}}' => 'Replace 2',
	'{{tag3}}' => 'Replace 3',
];

$currentDir = __DIR__.DIRECTORY_SEPARATOR;
$replacer::replaceTags($currentDir.'example.docx', $tagsToReplace, $currentDir.'example_replaced.docx');
```
