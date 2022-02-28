<?php

namespace Arkye\Support\DataTransferObject\Casters;

use Exception;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Caster;

class CollectionCaster implements Caster
{

  /**
   * @throws Exception
   */
  public function cast(mixed $value): Collection
  {
    if ($value instanceof Collection) {
      return $value;
    }

    if (! is_array($value) && ! is_string($value)) {
      throw new Exception("Can only cast arrays or comma separated strings to Collection");
    }

    if (is_array($value)) {
      return Collection::make($value);
    }

    return Collection::make(explode(',', $value));
  }

}
