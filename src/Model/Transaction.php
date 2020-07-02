<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Model;


class Transaction
{
	public function setBin(string $val) {
		$this->attributes['bin'] = $val;
	}

	public function getBin() : string
	{
		return $this->attributes['bin'];
	}

	public function setAmount(string $val)
	{
		$this->attributes['amount'] = $val;
	}

	public function getAmount() : string
	{
		return $this->attributes['amount'];
	}

	public function setCurrency(string $val)
	{
		$this->attributes['currency'] = $val;
	}

	public function getCurrency() : string
	{
		return $this->attributes['currency'];
	}
}
