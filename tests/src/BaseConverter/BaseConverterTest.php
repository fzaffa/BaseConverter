<?php
namespace Fzaffa\BaseConverter;

use PHPUnit\Framework\TestCase;

class BaseConverterTest extends TestCase{

    private $converter;

    public function setUp()
    {
        $this->converter = new BaseConverter(ConverterRangeTypes::ALPHA_ULCASE);
    }

    public function testAutomaticConvertType()
    {
        $this->assertInternalType("int", $this->converter->convert("mnS"));

        $this->assertInternalType("string", $first = $this->converter->convert("1234"));
        $this->assertInternalType("string", $second = $this->converter->convert(1234));

        $this->assertEquals($second, $first);
    }
}