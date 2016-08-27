<?php
/**
 * Fzaffa/BaseConverter
 *
 *
 * @version 0.1-dev
 *
 * @author      Francesco Zaffaroni
 * @link        http://github.com/fzaffa/baseConverter
 * @copyright   Copyright (c) 2016 Francesco Zaffaroni
 * @license     https://opensource.org/licenses/MIT
 *
 */
namespace Fzaffa\BaseConverter;

/**
 * Class BaseConverter
 * @package Fzaffa\BaseConverter
 */

class BaseConverter
{

    /**
     * The base, or length of the alphabet.
     *
     * @var int
     */
    protected $base;
    /**
     * The alphabet used for the conversion.
     *
     * @var array
     */
    protected $letters;

    /**
     * BaseConverter constructor.
     *
     * @param $letters can be an option or an array. Used to build the letters property.
     * @throws \Exception if the provided argument isn't a valid option or an array of characters.
     */
    public function __construct($letters)
    {
        if (!is_array($letters)) {
            switch ($letters) {
                case ConverterRangeTypes::ALPHA_ULCASE:
                    $letters = array_merge(range("a", "z"), range("A", "Z"));
                    break;
                case ConverterRangeTypes::ALPHA_LCASE:
                    $letters = range("a", "z");
                    break;
                case ConverterRangeTypes::ALPHA_UCASE:
                    $letters = range("A", "Z");
                    break;
                default:
                    throw new \Exception("Provided parameter must be an array of characters or an option.");
                    break;
            }
        }
        $this->letters = $letters;
        $this->base = count($letters);
    }

    /**
     * Automatically understands if the provided argument is a string or a number and acts accordingly.
     *
     * @param $arg string or numeric, the value to be converted.
     * @return int|string returns the converted value.
     * @throws \Exception if the argument isn't a string or isn't numeric.
     */
    public function convert($arg)
    {
        if (is_numeric($arg)) {
            return $this->convertFromIntToString($arg);
        } elseif (is_string($arg)) {
            return $this->convertFromStringToInt($arg);
        }
        throw new \Exception("Argument passed must be string or numeric", 1);
    }

    /**
     * Only converts an integer to a string.
     *
     * @param $int The number to be converted in string
     * @return string the converted value
     */
    public function convertFromIntToString($int)
    {
        if ($int < count($this->letters)) {
            return $this->letters[$int];
        }
        $returnValue = '';

        while ($int != 0) {
            $returnValue = $this->letters[bcmod($int, $this->base)] . $returnValue;
            $int = bcdiv($int, $this->base, 0);
        }

        return $returnValue;
    }

    /**
     * Oly converts a string to a number.
     *
     * @param $string the previously converted string.
     * @return int the integer returned.
     */
    public function convertFromStringToInt($string)
    {
        $lettersArray = str_split($string);
        $lettersArray = array_reverse($lettersArray);
        $number = 0;
        $index = 0;
        foreach ($lettersArray as $letter) {
            $num = array_search($letter, $this->letters);
            $num = $num * pow($this->base, $index);
            $number += $num;
            $index++;
        }

        return $number;
    }
}

