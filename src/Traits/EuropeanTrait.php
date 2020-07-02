<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Traits;
use Gtmangaliman\CommissionCalculator\Config\Countries;
use Gtmangaliman\CommissionCalculator\Config\CommissionRates;


trait EuropeanTrait
{
  public function europeanIssuedCard(string $countryCode) : bool
  {
  	  $euIssuesCountries = Countries::EU_ISSUED;
  	  return in_array($countryCode, $euIssuesCountries) ? true : false;
  }

  public function isEuropeanCurrency(string $currency) : bool
  {
	  return ($currency == 'EUR') ? true : false;
  }

  public function getEuropeanAmount(string $amount) : string
  {
  	  return $amount;
  }

  public function getNonEuropeanAmount(string $amount, string $exchangeRate) : string
  {
  	  return (string)($amount/$exchangeRate);
  }

  public function getAmountWithCommission(string $total, bool $europeanIssuedCard) : string
  {
  	  if ($europeanIssuedCard) {
  	  	  $amount = ($total*CommissionRates::EUROPEAN);
  	  } else {
  	  	  $amount = ($total*CommissionRates::NON_EUROPEAN);
  	  }

  	  return (string)$amount;
  }

}
