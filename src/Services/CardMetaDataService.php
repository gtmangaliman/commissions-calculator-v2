<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Services;
use Gtmangaliman\CommissionCalculator\Contracts\ClientInterface;
use Gtmangaliman\CommissionCalculator\Model\Transaction;
use Gtmangaliman\CommissionCalculator\Config\Api;
use Gtmangaliman\CommissionCalculator\Exceptions\CardMetaDataServiceException;

class CardMetaDataService
{
	public $client;

    public function __construct(ClientInterface $client)
    {
    	$this->client = $client;
    }

    public function data(Transaction $transaction) : array
    {
    	return $this->client->get(Api::BIN_LIST.$transaction->getBin());
    }

    public function countryCode(Transaction $transaction) : string
    {
    	$metaData = $this->data($transaction);

    	if (!isset($metaData['country']) && !isset($metaData['country']['alpha2'])) {
    		throw new CardMetaDataServiceException('Card Meta Data\'s Country Code not found.');
    	}

    	return $metaData['country']['alpha2'];
    }
}
