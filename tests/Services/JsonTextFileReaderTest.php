<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Tests\Service;

use PHPUnit\Framework\TestCase;
use Gtmangaliman\CommissionCalculator\Services\JsonTextFileReaderService;

class JsonTextFileReaderTest extends TestCase
{

	private $jsonTextFileReader;

	public function setUp() : void
	{
		$this->jsonTextFileReader = new JsonTextFileReaderService;
	}

	/**
	 * @param string $expected
     * @param string $fileName
	 *
     * @dataProvider dataProviderForReadJsonFileText
     */
    public function testReadJsonFileText(string $expected, string $fileName)
    {
        $this->assertSame($expected, $this->jsonTextFileReader->read($fileName));
    }

    public function dataProviderForReadJsonFileText()
    {
    	return [
    		['{"bin":"45717360","amount":"100.00","currency":"EUR"}
{"bin":"516793","amount":"50.00","currency":"USD"}
{"bin":"45417360","amount":"10000.00","currency":"JPY"}
{"bin":"41417360","amount":"130.00","currency":"USD"}
{"bin":"4745030","amount":"2000.00","currency":"GBP"}
', 'transactions.txt']
    	];
    }
}
