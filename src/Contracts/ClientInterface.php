<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Contracts;


interface ClientInterface
{
  /**
   * Reads file.
   */
  public function get(string $file);
}
