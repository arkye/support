<?php

namespace Tests;

use Arkye\Support\Tests\DTO\MyDTO;
use Arkye\Support\Tests\DTO\TestDTO;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class DataTransferObjectTest extends TestCase
{

  public function testCarbonCaster()
  {
    $dto = new TestDTO(sentAt: '2000-01-01');

    $this->assertInstanceOf(Carbon::class, $dto->sentAt);
  }

  /**
   * @throws UnknownProperties
   */
  public function testCollectionCaster()
  {
    $dto = new TestDTO(tags: ['tag1', 'tag2']);

    $this->assertInstanceOf(Collection::class, $dto->tags);
  }

  /**
   * @throws UnknownProperties
   */
  public function testCaseTransformer()
  {
    $input = [
      'id' => 1,
      'sent_at' => Carbon::now(),
      'full_name' => 'My Name',
      'tags' => [],
    ];

    $dto = new TestDTO($input);

    $this->assertJsonStringEqualsJsonString($dto->toJson(), json_encode($input));

    $input = [
      'id' => 1,
      'sent-at' => Carbon::now(),
      'full-name' => 'My Name',
      'tags' => [],
    ];

    $dto = new TestDTO($input);

    $this->assertJsonStringEqualsJsonString($dto->toJson(), json_encode(array_convert_key_case($input, 'snake')));

    $input = [
      'Id' => 1,
      'SentAt' => Carbon::now(),
      'FullName' => 'My Name',
      'Tags' => [],
    ];

    $dto = new MyDTO($input);

    $this->assertJsonStringEqualsJsonString($dto->toJson(), json_encode(array_convert_key_case($input, 'camel')));
  }

}
