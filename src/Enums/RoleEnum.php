<?php

namespace Bi\Users\Enums;

use Spatie\Permission\Models\Role;
use Bi\Users\Interfaces\RoleInterface;
use Bi\Helpers\Traits\Enum\ArrayableEnumTrait;
use Bi\Helpers\Traits\Enum\RandomableEnumTrait;
use Bi\Helpers\Traits\Enum\FilterableEnumTrait;

enum RoleEnum implements RoleInterface
{
    use ArrayableEnumTrait, RandomableEnumTrait, FilterableEnumTrait;

    case MASTER;

    case ADMIN;

    case ACCOUNTANT;

    case CONTRACTOR;

    case CUSTOMER;

    public function getObject()
    {
        return Role::where('name', $this->name)->first();
    }
}
