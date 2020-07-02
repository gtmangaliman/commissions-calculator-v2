<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Contracts;


interface ReaderInterface
{
   /**
   * Reads file.
   */
  public function read(string $file): string;
}
