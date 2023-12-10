<?php

use Bi\Users\Models\User;
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
    'account'     => [

        /*
        |--------------------------------------------------------------------------
        | Enable
        |--------------------------------------------------------------------------
        |
        | Using accounts as higher level or relations. If this is disabled then
        | account model will be ignored and should not be used.
        |
        */
        'enable' => env('BI_ACCOUNT_ENABLE', true),

        /*
        |--------------------------------------------------------------------------
        | Table
        |--------------------------------------------------------------------------
        |
        */
        'table' => env('BI_ACCOUNT_TABLE', 'accounts'),

        /*
        |--------------------------------------------------------------------------
        | Account model
        |--------------------------------------------------------------------------
        |
        | You can create your own methods by extending this \NRB\Address\Address
        | class and this with your full class name.
        |
        */
        'model' => \Bi\Users\Models\Account::class,

        /*
        |--------------------------------------------------------------------------
        | Type of Accounts
        |--------------------------------------------------------------------------
        |
        | You can create your own methods by extending this \NRB\Address\Address
        | class and this with your full class name.
        |
        */
        'types' => \Bi\Users\Enums\AccountTypeEnum::class
    ],


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
