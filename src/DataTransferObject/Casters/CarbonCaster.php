<?php

namespace Arkye\Support\DataTransferObject\Casters;

use Carbon\Carbon;
use Exception;
use Spatie\DataTransferObject\Caster;

class CarbonCaster implements Caster
{

  /**
   * @throws Exception
   */
  public function cast(mixed $value): Carbon
  {
    if ($value instanceof Carbon) {
      return $value;
    }

    if (! is_string($value)) {
      throw new Exception("Can only cast strings to Carbon");
    }

    return Carbon::parse($value);
  }

}
