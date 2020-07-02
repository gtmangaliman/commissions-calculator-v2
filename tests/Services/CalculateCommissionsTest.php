<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Tests\Service;

use PHPUnit\Framework\TestCase;
use Gtmangaliman\CommissionCalculator\Services\CalculateCommissionsService;
use Gtmangaliman\CommissionCalculator\Model\Transaction;
use Gtmangaliman\CommissionCalculator\Model\CardMetaData;

class CalculateCommissionsTest extends TestCase
{
	private $calculateCommissions;

	public function setUp() : void
	{
		$this->calculateCommissions = new CalculateCommissionsService();
	}

	/**
	 * *
	 * @param string $transactionData
     * @param string $expected
     * @param string $exchangeRates
	 * @param string $countryCode
     *
     * @dataProvider dataProviderForTestCalculateCommissions
     */
    public function testCalculateCommissions(Transaction $transaction, string $expected, array $exchangeRates, string $countryCode) : void
    {
    	$cardMetaData = new CardMetaData();
    	$cardMetaData->setCountryCode($countryCode);

    	$this->assertSame($expected, $this->calculateCommissions->compute($transaction, $cardMetaData, $exchangeRates), 'Incorrect Commission Computation');
    }

    /**
	 * *
	 * @param string $amount
     * @param string $currency
     * @param string $exchangeRates
     * @param string $expected
     *
     * @dataProvider dataProviderForTestTotal
     */
    public function testTotal(string $amount, string $currency, string $exchangeRate, string $expected) : void
    {
    	$this->assertSame($expected, $this->calculateCommissions->total($amount, $currency, $exchangeRate), 'Incorrect computation of total');
    }

    public function dataProviderForTestTotal() : array
    {
    	$exchangeRates =  [
						    "JPY" => 120.25,
						    "GBP" => 0.90133,
						];
    	return [
    		'with exhange rate' => [
    			'amount' => '2000.00',
    			'currency' => 'GBP',
    			'exchangeRate' => '0.90225',
    			'expected' => '2216.6805209199'
    		],
    		'with zero exhange rate' => [
    			'amount' => '100.00',
    			'currency' => 'EUR',
    			'exchangeRate' => '0',
    			'expected' => '100.00'
    		],
    		'with european currency' => [
    			'amount' => '100.00',
    			'currency' => 'EUR',
    			'exchangeRate' => '0',
    			'expected' => '100.00'
    		],
    		'with non european currency' => [
    			'amount' => '10000.00',
    			'currency' => 'JPY',
    			'exchangeRate' => '121.24',
    			'expected' => '82.481029363246'
    		]
    	];
    }

    public function dataProviderForTestCalculateCommissions() : array
    {
    	$exchangeRates =  [
							"USD" => 1.12
						];

    	$eurTransaction = new Transaction();
    	$eurTransaction->setBin('45717360');
    	$eurTransaction->setAmount('100.00');
    	$eurTransaction->setCurrency('EUR');

    	$nonEurTransaction = new Transaction();
    	$nonEurTransaction->setBin('516793');
    	$nonEurTransaction->setAmount('50.00');
    	$nonEurTransaction->setCurrency('USD');

    	return [
    		'European transaction' => [
    			'transaction' => $eurTransaction,
    			'expected' => '1.00',
    			'exchangeRates' => $exchangeRates,
    			'countryCode' => 'DK'
    		],
    		'Non European transaction' => [
    			'transaction' => $nonEurTransaction,
    			'expected' => '0.45',
    			'exchangeRates' => $exchangeRates,
    			'countryCode' => 'LT'
    		]
    	];
    }
}
