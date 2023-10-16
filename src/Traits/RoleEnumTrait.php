<?php

namespace Bi\Users\Traits;

use Spatie\Permission\Models\Role;

trait RoleEnumTrait
{
    /**
     * @return Role|null
     */
    public function getObject(): ?Role
    {
        if (isset($this->value)) {
            return Role::where('name', $this->value)->first();
        }

        return Role::where('name', $this->name)->first();
    }
}
