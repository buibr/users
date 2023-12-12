<?php

namespace Bi\Users\Seeders;

use Exception;
use Bi\Users\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Bi\Users\Exception\BiException;
use Illuminate\Support\Facades\Log;
use Bi\Users\Interfaces\RoleInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role as SpatieRole;
use Bi\Users\Interfaces\RolePermissionsInterface;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = $this->createRoles();
        $permissions = $this->createPermissions();

        /** @var SpatieRole $role */
        foreach ($roles as $role) {
            $connection = $this->getLinked($role);

            $this->doConnect($role, $connection);
        }
    }

    private function createRoles(): array
    {
        $roles = config('bi-users.rbac.roles');

        if (my_is_enum($roles)) {
            $roles = $roles::cases();
        }

        $list = [];
        foreach ($roles as $role) {
            $name = null;

            if (is_string($role)) {
                $name = $role;
            }

            if (my_is_enum($role)) {
                $name = isset($role->value) ? $role->value : $role->name;
            }

            if (!$name) {
                throw new BiException('Invalid role name');
            }

            $list[$name] = SpatieRole::findOrCreate($name);
        }

        return $list;
    }

    private function createPermissions(): array
    {
        $permissions = config('bi-users.rbac.permissions');

        if (my_is_enum($permissions)) {
            $permissions = $permissions::cases();
        }

        $list = [];
        foreach ($permissions as $key => $permission) {
            $name = null;

            if (is_string($permission)) {
                $name = $permission;
            }

            if (my_is_enum($permission)) {
                $name = isset($permission->value) ? $permission->value : $permission->name;
            }

            if (!$name) {
                throw new BiException('Invalid permission name');
            }

            $list[$name] = Permission::findOrCreate($name);
        }

        return $list;
    }

    private function getLinked(SpatieRole $role)
    {
        /** @var RoleInterface[] $roles */
        $roles = config('bi-users.rbac.roles');

        /** @var RoleEnum $enumRole */
        $enumRole = $roles::from($role->name);

        $connection = config('bi-users.rbac.role_permissions');

        $permissions = [];

        if (class_exists($connection)) {
            $connection = new $connection;

            if(is_a($connection, RolePermissionsInterface::class)) {
                $permissions =  $connection::permissions($enumRole);
            }
        }

        if (is_array($connection)) {
            $permissions  = $connection[$enumRole->value] ?? [];
        }

        return $permissions ?? [];
    }

    private function doConnect(SpatieRole $role, iterable $permissions)
    {
        try {
            foreach ($permissions as $i => $permission) {
                $permissionObject = null;

                if (is_string($permission)) {
                    $permissionObject = Permission::findByName($permission);
                }

                if (my_is_enum($permission)) {
                    $permissionObject = $permission->getObject();
                }

                if (!is_a($permissionObject, Permission::class)) {
                    throw new BiException('Invalid permission name');
                }

                $role->givePermissionTo($permissionObject);
            }
        } catch (Exception $e) {
            Log::critical($e->getMessage());
        }
    }

    private function permissionsFromEnum(array $permissions)
    {
        foreach ($permissions::cases() as $key => $permission) {
            $name = $permission;

            if (my_is_enum($permission)) {
                $name = isset($permission->value) ? $permission->value : $permission->key;
            }

            $list[$name] = Permission::findOrCreate($name);
        }
    }
}
