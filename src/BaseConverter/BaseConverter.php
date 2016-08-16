<?php
namespace Fzaffa\BaseConverter;

class BaseConverter {
	
	private $letters;
	private $base;

	public function __construct($letters)
	{
		if(!is_array($letters))
		{
			switch($letters){
				case "azAZ":
					$letters = array_merge(range("a", "z"), range("A", "Z"));
					break;
				case "az":
					$letters = range("a", "z");
					break;
				case "AZ":
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

	public function convert($arg)
	{
		if(is_numeric($arg))
		{
			return $this->convertFromIntToString($arg);
		} elseif(is_string($arg)) {
			return $this->convertFromStringToInt($arg);
		}
		throw new Exception("Argument passed must be string or numeric", 1);
	}

	public function convertFromIntToString($int)
	{
		if($int < count($this->letters))
		{
			return $this->letters[$int];
		}
		$returnValue = '';

		while($int != 0)
		{
			$returnValue = $this->letters[bcmod($int, $this->base)].$returnValue;
			$int = bcdiv($int, $this->base, 0);
		}

		return $returnValue;
	}

	public function convertFromStringToInt($string)
	{
		$lettersArray = str_split($string);
		$lettersArray = array_reverse($lettersArray);
		$number = 0;
		$index = 0;
		foreach ($lettersArray as $letter){
			$num = array_search($letter, $this->letters);
			$num = $num * pow($this->base, $index);
			$number += $num;
			$index++;
		}

		return $number;
	}
}

