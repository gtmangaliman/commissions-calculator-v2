<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Services;

use Gtmangaliman\CommissionCalculator\Model\Transaction;
use Gtmangaliman\CommissionCalculator\Model\CardMetaData;
use Gtmangaliman\CommissionCalculator\Services\CardMetaDataService;
use Gtmangaliman\CommissionCalculator\Traits\EuropeanTrait;

class CalculateCommissionsService
{
	use EuropeanTrait;

    public function compute(Transaction $transaction, CardMetaData $cardMetaData, array $exchangeRates) : string
    {
    	$currency = $transaction->getCurrency();
    	$europeanIssuedCard = $this->europeanIssuedCard($cardMetaData->getCountryCode());
    	$exchangeRate = isset($exchangeRates[$currency]) ? $exchangeRates[$currency] : '0';

    	$total = $this->total($transaction->getAmount(), $currency, (string)$exchangeRate);
		$commission = $this->getAmountWithCommission($total, $europeanIssuedCard);

		return number_format((float)$commission, 2);
    }

    public function total(string $amount, string $currency, string $exchangeRate) : string
    {
    	if ($exchangeRate === '0') {
			if ($this->isEuropeanCurrency($currency)) {
				$total = $this->getEuropeanAmount($amount);
			}
		} else {
			if (!$this->isEuropeanCurrency($currency)) {
				$total = $this->getNonEuropeanAmount($amount, (string)$exchangeRate);
			}
		}

		return $total;
    }
}
