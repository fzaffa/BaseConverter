#BaseConverter
The purpose of this library is to convert decimal numbers to higher bases represented only by alphabet characters to render them easier to remember and easier on the eyes for permalinks and similar applications.

#Installation
```bash
    $ composer require fzaffa/baseconverter
```

```json
    {
        "require": {
            "fzaffa/baseconverter": "^0.1"
        }
    }
```

#Usage

```php
    use Fzaffa\BaseConverter\BaseConverter;
    use Fzaffa\BaseConverter\ConverterRangeTypes;

    require "vendor/autoload.php"

    $converter = new BaseConverter(ConverterRangeTypes::azAZ);

    echo $converter->convert(34523) //Outputs: mNV

    echo $converter->convert(mNV) //Outputs: 34523
```

#Notes
Will add tests soon.

#License
MIT