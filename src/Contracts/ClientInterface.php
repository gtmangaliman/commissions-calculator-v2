<?php
declare(strict_types=1);

namespace Gtmangaliman\CommissionCalculator\Contracts;


interface ClientInterface
{
  public function get(string $file);
}
