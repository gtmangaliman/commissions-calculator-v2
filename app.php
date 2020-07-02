<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use Gtmangaliman\CommissionCalculator\Services\JsonTextFileReaderService;
use Gtmangaliman\CommissionCalculator\Services\JsonTextFileParserService;
use Gtmangaliman\CommissionCalculator\Services\ExchangeRateService;
use Gtmangaliman\CommissionCalculator\Services\HttpClientService;
use Gtmangaliman\CommissionCalculator\Services\CalculateCommissionsService;
use Gtmangaliman\CommissionCalculator\Services\CardMetaDataService;
use Gtmangaliman\CommissionCalculator\Model\Transaction;
use Gtmangaliman\CommissionCalculator\Model\CardMetaData;

if (isset($argv)) {
	try {
		if (!isset($argv[1])) {
        	echo 'no file found'; //add exception for this
        	exit();
        }

        $reader = new JsonTextFileReaderService();
        $parser = new JsonTextFileParserService();

        $file = $argv[1];
        $data = $reader->read($file);

        //addJsonParse for return of read()
        //add error when url can't be read
    	$exchangeRateService = new ExchangeRateService(new HttpClientService());
    	$exchangeRates = $exchangeRateService->rates();

    	foreach ($parser->parse($data) as $item) {
    		if ($item) {
				$transaction = new Transaction();
				$transaction->setBin($item['bin']);
			    $transaction->setAmount($item['amount']);
			    $transaction->setCurrency($item['currency']);

			    $cardMetaDataService = new CardMetaDataService(new HttpClientService(), $transaction);
			    $cardMetaData = new CardMetaData();
			    $cardMetaData->setCountryCode($cardMetaDataService->countryCode());

			    $calculateCommissions = new CalculateCommissionsService();
			    echo $calculateCommissions->compute($transaction, $cardMetaData, $exchangeRates)."\n";
			}
    	}

    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }
}
