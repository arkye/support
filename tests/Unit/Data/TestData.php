<?php

namespace Arkye\Support\Tests\Unit\Data;

use Arkye\Support\Data\Data;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class TestData extends Data
{

  public ?int $id;
  public ?Carbon $sentAt;
  public ?string $fullName;
  public ?Collection $tags;
  public ?TestData $nested;

}
