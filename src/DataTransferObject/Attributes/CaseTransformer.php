<?php

namespace Arkye\Support\DataTransferObject\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class CaseTransformer
{

  /**
   * @param string $input DTO case
   * @param string|null $output Serialization case (toArray or toJson)
   */
  public function __construct(public string $input, public ?string $output)
  {
    $this->output ??= $this->input;
  }

}
