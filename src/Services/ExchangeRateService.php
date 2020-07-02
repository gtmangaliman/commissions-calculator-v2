<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Services;

use Gtmangaliman\CommissionCalculator\Contracts\ClientInterface;
use Gtmangaliman\CommissionCalculator\Config\Api;

class ExchangeRateService
{
	public $data;

    public function __construct(ClientInterface $client)
    {
    	$this->data = $client->get(Api::EXHANGE_RATE);
    }

    public function rates() : array
    {
    	//check if rates are not avaialble
    	return isset($this->data['rates']) ? $this->data['rates'] : [];
    }
}
