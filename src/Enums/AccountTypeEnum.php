<?php

namespace Bi\Users\Enums;

use Bi\Helpers\Traits\Enum\ArrayableEnumTrait;
use Bi\Helpers\Traits\Enum\RandomableEnumTrait;
use Bi\Helpers\Traits\Enum\FilterableEnumTrait;

enum AccountTypeEnum
{
    use ArrayableEnumTrait, RandomableEnumTrait, FilterableEnumTrait;

    case USER;

    case COMPANY;

    case ENTERPRISE;

    case ADMINISTRATOR;
}
