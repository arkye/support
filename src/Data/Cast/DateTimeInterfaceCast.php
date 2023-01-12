<?php

namespace Arkye\Support\Data\Cast;

use DateTimeInterface;
use DateTimeZone;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Exceptions\CannotCastDate;
use Spatie\LaravelData\Support\DataProperty;

class DateTimeInterfaceCast extends \Spatie\LaravelData\Casts\DateTimeInterfaceCast
{

    public function cast(DataProperty $property, mixed $value, array $context): DateTimeInterface|Uncastable
    {
        $formats = collect($this->format ?? config('data.date_format'));

        $type = $this->type ?? $property->type->findAcceptedTypeForBaseType(DateTimeInterface::class);

        if ($type === null) {
            return Uncastable::create();
        }

        /** @var DateTimeInterface|null $datetime */
        $datetime = $formats
            ->map(fn (string $format) => rescue(fn () => $type::createFromFormat(
                $format,
                $value,
                isset($this->timeZone) ? new DateTimeZone($this->timeZone) : null
            ), report: false))
            ->first(fn ($value) => (bool) $value);

        if (! $datetime && $type === 'Carbon\Carbon') {
          $datetime = $type::parse($value, isset($this->timeZone) ? new DateTimeZone($this->timeZone) : null);
        }

        if (! $datetime) {
            throw CannotCastDate::create($formats->toArray(), $type, $value);
        }

        if ($this->setTimeZone) {
            return $datetime->setTimezone(new DateTimeZone($this->setTimeZone));
        }

        return $datetime;
    }
}
