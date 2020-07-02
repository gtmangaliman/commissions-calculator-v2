<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Services;

use Gtmangaliman\CommissionCalculator\Contracts\ReaderInterface;
use Gtmangaliman\CommissionCalculator\Traits\JsonTextFileReaderTrait;
use Gtmangaliman\CommissionCalculator\Exceptions\JsonTextFileReaderException;

class JsonTextFileReaderService implements ReaderInterface
{
	use JsonTextFileReaderTrait;

    public function read(string $file) : string
    {
    	$ext = pathinfo($file, PATHINFO_EXTENSION);

    	if ($this->withValidExtension($ext) && file_exists($file)) {
    		return file_get_contents($file);
    	} else {
    		throw new JsonTextFileReaderException;
    	}
    }
}
