<?php

namespace Bi\Users\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Bi\Users\Interfaces\RolePermissionsInterface;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = $this->createPermissions();

        $roles = $this->createRoles();

        foreach ($roles as $role) {
            $connection = $this->getLinked($role);

            try {
                foreach ($connection as $i => $permission) {

                    $permissionName = $permission;

                    if (my_is_enum($permission)) {
                        $permissionName = isset($permission->value) ? $permission->value : $permission->name;
                    }

                    $role->getObject()->givePermissionTo($permissionName);
                }
            } catch (Exception $e) {
            }
        }

    }

    private function createPermissions(): array
    {
        $permissions = config('bi-users.rbac.permissions');

        $list = [];
        foreach ($permissions as $key => $permission) {

            $name = $permissions;

            if (my_is_enum($permission)) {
                $name = isset($permission->value) ? $permission->value : $permission->key;
            }

            $list[$name] = Permission::findOrCreate($name);
        }

        return $list;
    }

    private function createRoles(): array
    {
        $roles = config('bi-users.rbac.roles');

        $list = [];
        foreach ($roles as $role) {

            $name = $role;

            if (my_is_enum($role)) {
                $name = isset($role->value) ? $role->value : $role->key;
            }

            $list[$name] = Role::findOrCreate($name);
        }

        return $list;
    }

    private function getLinked($role)
    {
        $connection = config('bi-users.rbac.role_permissions');

        if (is_a($connection, RolePermissionsInterface::class)) {
            return $connection::permissions($role);
        }

        return $connection[$role];
    }
}
