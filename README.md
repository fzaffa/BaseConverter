#BaseConverter
The purpose of this library is to convert decimal numbers to higher bases represented only by alphabet characters to render them easier to remember and easier on the eyes for permalinks and similar applications.

##Installation
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

##Usage

```php
    use Fzaffa\BaseConverter\BaseConverter;
    use Fzaffa\BaseConverter\ConverterRangeTypes;

    require "vendor/autoload.php"

    $converter = new BaseConverter(ConverterRangeTypes::azAZ);

    echo $converter->convert(34523) //Outputs: mNV

    echo $converter->convert(mNV) //Outputs: 34523
```

The `convert()` method will automatically get the type of the argument, if it is numeric (also a string containing only numbers work) it will convert to a string, if it's a string it will convert to decimal. To force one or the other use `convertFromStringToInt` or `convertFromIntToString`.

The provided ranges are:

* `ConverterRangeTypes::az` for [a-z]
* `ConverterRangeTypes::AZ` for [A-Z]
* `ConverterRangeTypes::azAZ` for [a-zA-Z]

You can pass in any array of chars that will be used in lieu of their decimal representation (eg. 12 will be the 12th element of the array).

##Notes
Will add tests soon.

##Todo

* Handle cases where the target base is less than 10
* Write unit tests

##License
MIT