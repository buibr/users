<?php

namespace Bi\Users\Traits;

use Spatie\Permission\Models\Permission;

trait PermissionEnumTrait
{
    /**
     * @return Permission|null
     */
    public function getObject(): ?Permission
    {
        if (isset($this->value)) {
            return Permission::where('name', $this->value)->first();
        }

        return Permission::where('name', $this->name)->first();
    }
}
