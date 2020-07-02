<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Exceptions;

use Exception;

class FileNotFoundException extends Exception
{
	protected $message = 'File not found. Please indicate the filename as the second parameter.';

}
