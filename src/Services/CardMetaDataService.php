<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Services;
use Gtmangaliman\CommissionCalculator\Contracts\ClientInterface;
use Gtmangaliman\CommissionCalculator\Model\Transaction;
use Gtmangaliman\CommissionCalculator\Config\Api;
use Gtmangaliman\CommissionCalculator\Exceptions\CardMetaDataServiceException;

class CardMetaDataService
{
	public $data;

	public $client;

    public function __construct(ClientInterface $client, Transaction $transaction)
    {
    	$this->data = $client->get(Api::BIN_LIST.$transaction->getBin());
    }

    public function countryCode() : string
    {
    	if (!isset($this->data['country']) && !isset($this->data['country']['alpha2'])) {
    		throw new CardMetaDataServiceException('Card Meta Data\'s Country Code not found.');
    	}

    	return $this->data['country']['alpha2'];
    }
}
