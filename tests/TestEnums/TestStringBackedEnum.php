<?php

namespace Anik\PhpEnumEnhancements\Tests\TestEnums;

use Anik\PhpEnumEnhancements\Enhancement;

enum TestStringBackedEnum: string
{
    use Enhancement;

    case Id = 'id';
    case Name = 'name';
    case Age = 'age';
}
