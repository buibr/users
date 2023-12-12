<?php

namespace Bi\Users\Enums;

use Spatie\Permission\Models\Role;
use Bi\Users\Interfaces\RoleInterface;
use Bi\Helpers\Traits\Enum\ArrayableEnumTrait;
use Bi\Helpers\Traits\Enum\RandomableEnumTrait;
use Bi\Helpers\Traits\Enum\FilterableEnumTrait;

enum RoleEnum: string implements RoleInterface
{
    use ArrayableEnumTrait, RandomableEnumTrait, FilterableEnumTrait;

    case MASTER = 'master';

    case ADMIN = 'admin';

    case ACCOUNTANT = 'accountant';

    case CONTRACTOR = 'contractor';

    case CUSTOMER = 'customer';

    public function getObject()
    {
        return Role::where('name', $this->value)->first();
    }
}
