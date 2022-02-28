<?php

namespace Arkye\Support\Tests\DTO;

use Arkye\Support\DataTransferObject\Attributes\CaseTransformer;
use Arkye\Support\DataTransferObject\DataTransferObject;
use Carbon\Carbon;
use Illuminate\Support\Collection;

#[CaseTransformer('camel', 'snake')]
class TestDTO extends DataTransferObject
{

  public ?int $id;
  public ?Carbon $sentAt;
  public ?string $fullName;
  public ?Collection $tags;

}
