# DocumentTagReplacer

PHP library that can replace tags in documents, currently only docx files. 

Built with PHPWord.

## Usage

Specify array of tags and corresponding values. The values are then replaced for the tags in the given document.

```php
$replacer = DocumentTagReplacerFactory::getReplacer(DocumentTagReplacerFactory::TYPE_WORD);

$tagsToReplace = [
	'{{tag1}}' => 'Replace 1',
	'{{tag2}}' => 'Replace 2',
	'{{tag3}}' => 'Replace 3',
];

$replacer::replaceTags('example.docx', $tagsToReplace, 'example_replaced.docx');
```
## Troubleshooting

### Tags are not getting replaced
This usually occurs when the template file has some malformed tags in its XML representation of the document. 

A malformed {{company:name}} tag might look like this in the source:

```
<w:r w:rsidR="00810267">
	<w:rPr>
		<w:b/>
	</w:rPr>
	<w:t>{{</w:t>
</w:r>
<w:proofErr w:type="spellStart"/>
<w:r w:rsidR="00810267">
	<w:rPr>
		<w:b/>
	</w:rPr>
	<w:t>company:name</w:t>
</w:r>
<w:proofErr w:type="spellEnd"/>
<w:r w:rsidR="00810267">
	<w:rPr>
		<w:b/>
	</w:rPr>
	<w:t>}}</w:t>
</w:r>
```

In order to determine whether your template file contains malformed tags, extract the file or open it in a zip file browser and locate document.xml in word directory. Look for tags in this file. 

Usual reasons for malforming are bookmarks and spellchecking.

Bookmarks problem can be resolved by deleting the tag (in Word) and writing it again as a whole.
Spellcheck problem can be resolved by saving the file with spellchecking turned off. You might need to make a change to the file, save it and then remove the change and save it again.
