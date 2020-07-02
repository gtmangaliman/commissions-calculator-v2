<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Exceptions;

use Exception;

class JsonTextFileReaderException extends Exception
{
	protected $message = 'File should exist and must have a txt file type.';
}
