<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Contracts;


interface ParserInterface
{
   /**
   * parses data
   */
  public function parse(string $data): array;
}
