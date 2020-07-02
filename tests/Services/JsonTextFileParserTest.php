<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Tests\Service;

use PHPUnit\Framework\TestCase;
use Gtmangaliman\CommissionCalculator\Services\JsonTextFileParserService;


class JsonTextFileParserServiceTest extends TestCase
{

	private $jsonTextFileReader;

	public function setUp() : void
	{
		$this->jsonTextFileParser = new JsonTextFileParserService;
	}
	/**
	 * @param array $expected
	 *
     * @dataProvider dataProviderForPaseJsonFileText
     */
    public function testParseJsonFileText(array $expected)
    {
    	$this->assertSame($expected, $this->jsonTextFileParser->parse(file_get_contents('transactions.txt')));
    }

    public function dataProviderForPaseJsonFileText()
    {
    	$transactions = [
						  0 => [
						    "bin" => "45717360",
						    "amount" => "100.00",
						    "currency" => "EUR",
						  ],
						  1 => [
						    "bin" => "516793",
						    "amount" => "50.00",
						    "currency" => "USD"
						  ],
						  2 => [
						    "bin" => "45417360",
						    "amount" => "10000.00",
						    "currency" => "JPY"
						  ],
						  3 => [
						    "bin" => "41417360",
						    "amount" => "130.00",
						    "currency" => "USD"
						  ],
						  4 => [
						    "bin" => "4745030",
						    "amount" => "2000.00",
						    "currency" => "GBP"
						  ]
						];

    	return [
    		[$transactions]
    	];
    }
}
