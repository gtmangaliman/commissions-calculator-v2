<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Exceptions;

use Exception;

class JsonTextFileParserException extends Exception
{
	protected $message = 'Data to be parsed should not be empty.';

}
