<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Services;

use Gtmangaliman\CommissionCalculator\Contracts\ClientInterface;
use Gtmangaliman\CommissionCalculator\Exceptions\HttpClientServiceException;


class HttpClientService implements ClientInterface
{
    public function get(string $url) : array
    {
		$pageDocument = @file_get_contents($url);

		if ($pageDocument === false) {
		    throw new HttpClientServiceException($url.' does not exist.');
		}

		$opts = [
		  'http'=>[
		    'method'=>"GET",
		    'header'=>"Accept-language: en\r\n"
		  ]
		];

		$context = stream_context_create($opts);
		$data = file_get_contents($url, false, $context);

        return ($data) ? json_decode($data, true) : [];
    }
}
