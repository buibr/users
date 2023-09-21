<?php

use Bi\Users\User;
use Bi\Users\Enums\RoleEnum;
use Bi\Users\Enums\PermissionEnum;
use Bi\Users\Enums\RolePermissions;

return [

    /*
    |--------------------------------------------------------------------------
    | User model
    |--------------------------------------------------------------------------
    |
    | You can change the user model or extend the default one from this plugin
    |
    */
    'model'       => User::class,

    /*
    |--------------------------------------------------------------------------
    | Using
    |--------------------------------------------------------------------------
    |
    | Using accounts as belong to on users. If this is disabled then
    | account model will be ignored and should not be used.
    |
    */
    'use_account' => true,

    /*
    |--------------------------------------------------------------------------
    | Delete method
    |--------------------------------------------------------------------------
    |
    | When you want to use soft delete for users.
    |
    */
    'soft_delete' => true,


    /*
    |--------------------------------------------------------------------------
    | Role based access control
    |--------------------------------------------------------------------------
    |
    | Defining user roles and permissions that should be attached.
    |
    */
    'rbac'        => [

        /*
        |--------------------------------------------------------------------------
        | Roles model
        |--------------------------------------------------------------------------
        |
        | If you want to specify custom roles in your application, you can
        | create your own enum class and define roles
        |
        */
        'roles'            => RoleEnum::class,

        /*
        |--------------------------------------------------------------------------
        | Permissions list overrides enum
        |--------------------------------------------------------------------------
        |
        | If you dont want to have all permissions in this package you can
        | create your own enum class and define permissions
        |
        */
        'permissions'      => PermissionEnum::class,

        /*
        |--------------------------------------------------------------------------
        | Role permissions
        |--------------------------------------------------------------------------
        |
        | Define here what permissions each role have.
        | Accepts enum that implements RolePermissionInterface
        | or array as example:.
        | [
        |   'ROLE' => [
        |       'permission1',
        |       'permission2',
        |       'permission3',
        |   ]
        | ]
        |
        */
        'role_permissions' => RolePermissions::toArray(),
    ],
];
