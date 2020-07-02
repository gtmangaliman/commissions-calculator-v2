<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Services;
use Gtmangaliman\CommissionCalculator\Contracts\ClientInterface;
use Gtmangaliman\CommissionCalculator\Model\Transaction;
use Gtmangaliman\CommissionCalculator\Config\Api;

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
    	return $this->data['country']['alpha2'];
    }
}
