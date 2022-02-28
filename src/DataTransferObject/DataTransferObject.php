<?php

namespace Arkye\Support\DataTransferObject;

use Arkye\Support\DataTransferObject\Attributes\CaseTransformer;
use Arkye\Support\DataTransferObject\Casters\CarbonCaster;
use Arkye\Support\DataTransferObject\Casters\CollectionCaster;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use ReflectionClass;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Stringable;

#[DefaultCast(Carbon::class, CarbonCaster::class)]
#[DefaultCast(Collection::class, CollectionCaster::class)]
class DataTransferObject extends \Spatie\DataTransferObject\DataTransferObject implements Arrayable, Jsonable, Stringable
{

  private ?string $inputCase;
  private ?string $outputCase;

  /**
   * @throws UnknownProperties
   */
  final public function __construct(...$args)
  {
    $this->setCaseTransformation();

    parent::__construct($this->getArgs($args));
  }

  private function getArgs(array $args): array
  {
    if (is_array($args[0] ?? null)) {
      $args = $args[0];
    }

    return $this->inputCase !== null
      ? array_convert_key_case($args, $this->inputCase, false)
      : $args;
  }

  private function setCaseTransformation(): void
  {
    $caseTransformer = ((new ReflectionClass($this))
      ->getAttributes(CaseTransformer::class)[0] ?? null)
      ?->newInstance();

    $this->inputCase = $caseTransformer?->input;
    $this->outputCase = $caseTransformer?->output;
  }

  /**
   * @inheritDoc
   */
  public function toJson($options = 0): string
  {
    return json_encode($this->toArray(), $options);
  }

  /**
   * @inheritDoc
   */
  public function toArray(): array
  {
    if ($this->outputCase === null) {
      return parent::toArray();
    }

    return array_convert_key_case(parent::toArray(), $this->outputCase, false);
  }

  /**
   * @inheritDoc
   */
  public function __toString()
  {
    return $this->toJson();
  }

}
