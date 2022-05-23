<?php

namespace Anik\PhpEnumEnhancements\Tests\Unit;

use Anik\PhpEnumEnhancements\Tests\TestEnums\TestIntegerBackedEnum;
use Anik\PhpEnumEnhancements\Tests\TestEnums\TestStringBackedEnum;
use Anik\PhpEnumEnhancements\Tests\TestEnums\TestUnitEnum;
use PHPUnit\Framework\TestCase;

class EnhancementTest extends TestCase
{
    public function __strtoupper(string|int $item): string
    {
        return sprintf('__%s__', strtoupper($item));
    }

    public function __strtolower(string|int $item): string
    {
        return sprintf('__%s__', strtolower($item));
    }

    public function test_name_method_should_return_as_it_is_without_callback()
    {
        $this->assertSame(['Id', 'Name', 'Age'], TestIntegerBackedEnum::names());
        $this->assertSame(['Id', 'Name', 'Age'], TestStringBackedEnum::names());
        $this->assertSame(['Id', 'Name', 'Age'], TestUnitEnum::names());
    }

    public function test_name_method_should_use_callback_if_passed()
    {
        $this->assertSame(['ID', 'NAME', 'AGE'], TestIntegerBackedEnum::names('strtoupper'));
        $this->assertSame(['ID', 'NAME', 'AGE'], TestStringBackedEnum::names('strtoupper'));
        $this->assertSame(['ID', 'NAME', 'AGE'], TestUnitEnum::names('strtoupper'));
    }

    public function test_value_method_should_return_as_it_is_without_callback()
    {
        $this->assertSame([1, 2, 3], TestIntegerBackedEnum::values()); // strict check, integer
        $this->assertSame(['id', 'name', 'age'], TestStringBackedEnum::values());
    }

    public function test_value_method_should_use_callback_if_passed()
    {
        $this->assertSame(['1', '2', '3'], TestIntegerBackedEnum::values('strtoupper')); // casts to string
        $this->assertSame(['ID', 'NAME', 'AGE'], TestStringBackedEnum::values('strtoupper'));
        $this->assertSame(['__ID__', '__NAME__', '__AGE__'], TestStringBackedEnum::values([$this, '__strtoupper']));
    }

    public function test_kv_pair_method_should_return_as_it_is_without_callback()
    {
        $this->assertSame(
            [1 => 'Id', 2 => 'Name', 3 => 'Age'],
            TestIntegerBackedEnum::kvPair()
        );
        $this->assertSame(
            ['id' => 'Id', 'name' => 'Name', 'age' => 'Age'],
            TestStringBackedEnum::kvPair()
        );
    }

    public function test_kv_pair_method_should_use_callback_if_passed()
    {
        $this->assertSame(
            [1 => 'ID', 2 => 'NAME', 3 => 'AGE'],
            TestIntegerBackedEnum::kvPair('strtoupper', 'strtolower')
        );
        $this->assertSame(
            ['__ID__' => '__id__', '__NAME__' => '__name__', '__AGE__' => '__age__'],
            TestStringBackedEnum::kvPair([$this, '__strtolower'], [$this, '__strtoupper'])
        );
    }

    public function test_kv_pair_method_should_consider_valueAsKey_param_to_make_keys()
    {
        $this->assertSame(
            [1 => 'Id', 2 => 'Name', 3 => 'Age'],
            TestIntegerBackedEnum::kvPair(valueAsKey: true)
        );
        $this->assertSame(
            ['id' => 'Id', 'name' => 'Name', 'age' => 'Age'],
            TestStringBackedEnum::kvPair(valueAsKey: true)
        );

        $this->assertSame(
            ['Id' => 1, 'Name' => 2, 'Age' => 3],
            TestIntegerBackedEnum::kvPair(valueAsKey: false)
        );
        $this->assertSame(
            ['Id' => 'id', 'Name' => 'name', 'Age' => 'age'],
            TestStringBackedEnum::kvPair(valueAsKey: false)
        );
    }
}
