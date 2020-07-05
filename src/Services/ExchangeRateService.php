<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Services;

use Gtmangaliman\CommissionCalculator\Contracts\ClientInterface;
use Gtmangaliman\CommissionCalculator\Config\Api;

class ExchangeRateService
{
	public $client;

    public function __construct(ClientInterface $client)
    {
    	$this->client = $client;
    }

    public function data() : array
    {
    	return $this->client->get(Api::EXHANGE_RATE);
    }

    public function rates() : array
    {
    	$latestRates = $this->data();

    	return isset($latestRates['rates']) ? $latestRates['rates'] : [];
    }
}
