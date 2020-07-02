<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Traits;


trait JsonTextFileReaderTrait
{
	public function withValidExtension(string $extension) : bool
    {
    	return ($extension == 'txt') ? true : false;
    }
}
