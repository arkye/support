<?php

namespace Arkye\Support\Data;

use Arkye\Support\Data\Resolvers\ConstructResolver;

abstract class Data extends \Spatie\LaravelData\Data
{

  public function __construct(...$args)
  {
    if (is_array($args[0] ?? null)) {
      $args = $args[0];
    }

    app(ConstructResolver::class)->execute($this, collect($args));
  }

}
