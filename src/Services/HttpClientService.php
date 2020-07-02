<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Services;

use Gtmangaliman\CommissionCalculator\Contracts\ClientInterface;

class HttpClientService implements ClientInterface
{
    public function get(string $url) : array
    {
		$opts = [
		  'http'=>[
		    'method'=>"GET",
		    'header'=>"Accept-language: en\r\n"
		  ]
		];

		$context = stream_context_create($opts);

		$data = file_get_contents($url, false, $context);

        return json_decode($data, true);
    }
}
