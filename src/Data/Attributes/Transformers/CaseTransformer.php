<?php

namespace Arkye\Support\Data\Attributes\Transformers;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class CaseTransformer
{

  /**
   * @param string $classCase DTO case
   * @param string|null $outputCase toArray or toJson map keys
   */
  public function __construct(public string $classCase, public ?string $outputCase = null)
  {
    $this->outputCase ??= $this->classCase;
  }

}
