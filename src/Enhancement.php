<?php

namespace Anik\PhpEnumEnhancements;

use BackedEnum;
use UnitEnum;

trait Enhancement
{
    public function getName(?callable $func = null): string
    {
        return is_callable($func) ? call_user_func_array($func, [$this->name]) : $this->name;
    }

    public function getValue(?callable $func = null): int|string
    {
        return is_callable($func) ? call_user_func_array($func, [$this->value]) : $this->value;
    }

    public static function names(?callable $callback = null): array
    {
        return array_map(
            fn(UnitEnum $item) => $item->getName($callback),
            self::cases()
        );
    }

    public static function values(?callable $callback = null): array
    {
        return array_map(
            fn(BackedEnum $item) => $item->getValue($callback),
            self::cases()
        );
    }

    public static function kvPair(
        ?callable $nameCallback = null,
        ?callable $valueCallback = null,
        bool $valueAsKey = true,
    ): array {
        $values = static::values($valueCallback);
        $keys = static::names($nameCallback);

        return array_combine(
            $valueAsKey ? $values : $keys,
            $valueAsKey ? $keys : $values
        );
    }
}
