<?php

namespace Arkye\Support\Data\Cast;

use Exception;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class CollectionCast implements Cast
{

  /**
   * @throws Exception
   */
  public function cast(DataProperty $property, mixed $value, array $context): Collection
  {
    if ($value instanceof Collection) {
      return $value;
    }

    if (! is_array($value) && ! is_string($value)) {
      throw new Exception("Attribute `{$value}` should be an array or comma separated string");
    }

    if (is_array($value)) {
      return Collection::make($value);
    }

    return Collection::make(explode(',', $value));
  }

}
