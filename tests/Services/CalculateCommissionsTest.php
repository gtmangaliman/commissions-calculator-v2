<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Tests\Service;

use PHPUnit\Framework\TestCase;
use Gtmangaliman\CommissionCalculator\Services\CalculateCommissionsService;
use Gtmangaliman\CommissionCalculator\Model\Transaction;
use Gtmangaliman\CommissionCalculator\Model\CardMetaData;

class CalculateCommissionsTest extends TestCase
{
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

    	$calculateCommissions = new CalculateCommissionsService();
    	$this->assertSame($expected, $calculateCommissions->compute($transaction, $cardMetaData, $exchangeRates), 'Incorrect Commission Computation');
    }

    public function dataProviderForTestCalculateCommissions() : array
    {
    	$eurTransaction = new Transaction();
    	$eurTransaction->setBin('45717360');
    	$eurTransaction->setAmount('100.00');
    	$eurTransaction->setCurrency('EUR');

    	$nonEurTransaction = new Transaction();
    	$nonEurTransaction->setBin('516793');
    	$nonEurTransaction->setAmount('50.00');
    	$nonEurTransaction->setCurrency('USD');

    	$exchangeRates = [
						    "CAD" => 1.5282,
						    "HKD" => 8.6805,
						    "ISK" => 155.6,
						    "PHP" => 56.075,
						    "DKK" => 7.4534,
						    "HUF" => 354.35,
						    "CZK" => 26.796,
						    "AUD" => 1.6321,
						    "RON" => 4.842,
						    "SEK" => 10.4865,
						    "IDR" => 15988,
						    "INR" => 84.712,
						    "BRL" => 6.0012,
						    "RUB" => 77.7516,
						    "HRK" => 7.567,
						    "JPY" => 120.25,
						    "THB" => 34.647,
						    "CHF" => 1.0637,
						    "SGD" => 1.56,
						    "PLN" => 4.4653,
						    "BGN" => 1.9558,
						    "TRY" => 7.6776,
						    "CNY" => 7.9206,
						    "NOK" => 10.8748,
						    "NZD" => 1.7465,
						    "ZAR" => 19.4883,
						    "USD" => 1.12,
						    "MXN" => 25.6315,
						    "ILS" => 3.8545,
						    "GBP" => 0.90133,
						    "KRW" => 1347.73,
						    "MYR" => 4.7914
						];

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
