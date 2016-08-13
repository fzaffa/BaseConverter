<?php
namespace Fzaffa\BaseConverter;

class BaseConverter {
	
	private $letters;
	private $base;

	public function __construct($letters)
	{
		if(is_string($letters))
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
		$decimalValues = [];
		$output = [];
		if($int >= $this->base)
		{
			$this->generateNumericValueForPlace($int, $decimalValues);
			$decimalValues = array_reverse($decimalValues);

			foreach ($decimalValues as $val) {
				$output[] = $this->letters[$val];
			}
		} else {
			$output[] = $this->letters[$int];
		}

		return join($output);
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

	private function generateNumericValueForPlace($int, array &$array)
	{
		$highestPower = $this->largestPowerOfBase($int);

		$difference = $int%$highestPower;

		if ($difference > $this->base) {
			 $this->generateNumericValueForPlace($difference, $array);
		} else 
		{
			$array[] = $difference;
		}
		$array[] = intval($int/$highestPower);
	}

	private function largestPowerOfBase($int)
	{
		if($int != $this->base)
		{
			$new = $this->base;
			while ($new < $int)
			{
				$new = $new*$this->base;
			}

			return $new/$this->base;
		}
		return $this->base;
	}
}

