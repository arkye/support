<?php

namespace Arkye\Support\Data;

abstract class Data extends \Spatie\LaravelData\Data
{

  public static function from(mixed ...$payloads): static
  {
    if (!isset($payloads[0])) {
      $payloads = [$payloads];
    }

    return parent::from(...$payloads);
  }

}
