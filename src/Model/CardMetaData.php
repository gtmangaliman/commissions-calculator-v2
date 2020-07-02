<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Model;


class CardMetaData
{
	public function setCountryCode(string $val)
	{
		$this->attributes['country_code'] = $val;
	}

	public function getCountryCode() : string
	{
		return $this->attributes['country_code'];
	}
}
