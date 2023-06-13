<?php

namespace Arkye\Support\Tests\Unit;

use Arkye\Support\Tests\TestCase;
use Arkye\Support\Tests\Unit\Data\TestData;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DataObjectTest extends TestCase
{

  public function testCarbonCaster()
  {
    $dto = TestData::from(sentAt: '2000-01-01');

    $this->assertInstanceOf(Carbon::class, $dto->sentAt);
  }

  public function testCollectionCaster()
  {
    $dto = TestData::from(tags: ['tag1', 'tag2']);

    $this->assertInstanceOf(Collection::class, $dto->tags);
  }

  public function testCaseTransformer()
  {
    $now = Carbon::now();

    $input = [
      'id' => 1,
      'sent_at' => $now,
      'full_name' => 'My Name',
      'tags' => [],
      'nested' => [
        'id' => 2,
        'sent_at' => null,
        'full_name' => 'My Second Name',
        'tags' => [],
        'nested' => null,
      ],
    ];

    $dto = TestData::from($input);

    $input['sent_at'] = $input['sent_at']->format(DATE_ATOM);

    $this->assertJsonStringEqualsJsonString($dto->toJson(), json_encode($input));
  }

}
