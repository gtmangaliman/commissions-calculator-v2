<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Services;

use Gtmangaliman\CommissionCalculator\Services\JsonTextFileParserService;
use Gtmangaliman\CommissionCalculator\Contracts\ParserInterface;

class JsonTextFileParserService implements ParserInterface
{
    public function parse(string $data) : array
    {
    	if (empty($data)) {
    		throw new \Gtmangaliman\CommissionCalculator\Exceptions\JsonTextFileParserException();
    	}

    	$data = explode("\n", $data);

    	return array_filter(array_map(function($item){
    		return json_decode($item, true);
    	}, $data));
    }
}
