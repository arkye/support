<?php

namespace Arkye\Support\Data\Cast;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\DataProperty;

class DataObjectCast implements Cast
{

  public function cast(DataProperty $property, mixed $value, array $context): mixed
  {
    $classname = array_keys($property->type->acceptedTypes)[0] ?? null;

    if ($classname === null) {
      return Uncastable::create();
    }

    if (method_exists($classname, 'from')) {
      return $classname::from($value);
    }

    if (is_array($value) && method_exists($classname, 'fromArray')) {
      return $classname::fromArray($value);
    }

    return new $classname($value);
  }

}
