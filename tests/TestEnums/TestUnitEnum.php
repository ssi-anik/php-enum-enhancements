<?php

namespace Anik\PhpEnumEnhancements\Tests\TestEnums;

use Anik\PhpEnumEnhancements\Enhancement;

enum TestUnitEnum
{
    use Enhancement;

    case Id;
    case Name;
    case Age;
}
