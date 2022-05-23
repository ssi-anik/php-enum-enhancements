<?php

namespace Anik\PhpEnumEnhancements\Tests\TestEnums;

use Anik\PhpEnumEnhancements\Enhancement;

enum TestIntegerBackedEnum: int
{
    use Enhancement;

    case Id = 1;
    case Name = 2;
    case Age = 3;
}
