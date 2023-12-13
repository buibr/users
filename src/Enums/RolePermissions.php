<?php

namespace Bi\Users\Enums;

use Illuminate\Support\Collection;
use Bi\Users\Interfaces\RoleInterface;
use Bi\Users\Interfaces\RolePermissionsInterface;

class RolePermissions implements RolePermissionsInterface
{
    /**
     * @return array<string, iterable<int, \Bi\Users\Enums\PermissionEnum>>
     */
    public static function toArray(): array
    {
        $list = [];

        foreach (RoleEnum::cases() as $roleEnum) {
            $list[$roleEnum->name] = self::permissions($roleEnum);
        }

        return $list;
    }

    /**
     * @return array<int, PermissionEnum>
     */
    public static function permissions(RoleInterface $role): iterable
    {
        /** @phpstan-ignore-next-line */
        return match ($role) {
            RoleEnum::MASTER => self::masterPermissions(),
            RoleEnum::ADMIN => self::adminPermissions(),
            RoleEnum::ACCOUNTANT => self::accountantPermissions(),
            RoleEnum::CONTRACTOR => self::contractorPermissions(),
            RoleEnum::CUSTOMER => self::customerPermissions(),
        };
    }

    /**
     * @return array<int, PermissionEnum>
     */
    private static function masterPermissions(): array
    {
        return PermissionEnum::cases();
    }

    /**
     * @return Collection<int, PermissionEnum>
     */
    private static function adminPermissions(): iterable
    {
        /** @phpstan-ignore-next-line */
        return collect(
            PermissionEnum::filter([
                PermissionEnum::MASTER_VIEW,
                PermissionEnum::MASTER_CREATE,
                PermissionEnum::MASTER_UPDATE,
                PermissionEnum::MASTER_DELETE,
            ])
        );
    }

    /**
     * @return Collection<int, PermissionEnum>
     */
    private static function accountantPermissions(): iterable
    {
        return collect([
            PermissionEnum::CUSTOMER_VIEW,
            PermissionEnum::CONTRACTOR_VIEW,
            PermissionEnum::PROJECT_VIEW,
            PermissionEnum::PROJECT_CREATE,
            PermissionEnum::PROJECT_UPDATE,
            PermissionEnum::PROJECT_DELETE,
            PermissionEnum::ESTIMATE_VIEW,
            PermissionEnum::ESTIMATE_CREATE,
            PermissionEnum::ESTIMATE_UPDATE,
            PermissionEnum::ESTIMATE_DELETE,
            PermissionEnum::INVOICE_VIEW,
            PermissionEnum::INVOICE_CREATE,
            PermissionEnum::INVOICE_UPDATE,
            PermissionEnum::INVOICE_DELETE,
            PermissionEnum::PRODUCT_VIEW,
            PermissionEnum::PRODUCT_CREATE,
            PermissionEnum::PRODUCT_UPDATE,
            PermissionEnum::PRODUCT_DELETE,
            PermissionEnum::SERVICE_VIEW,
            PermissionEnum::SERVICE_CREATE,
            PermissionEnum::SERVICE_UPDATE,
            PermissionEnum::SERVICE_DELETE,
        ]);
    }

    /**
     * @return Collection<int, PermissionEnum>
     */
    private static function contractorPermissions(): iterable
    {
        return collect([
            PermissionEnum::CUSTOMER_VIEW,
            PermissionEnum::PROJECT_VIEW,
            PermissionEnum::PRODUCT_CREATE,
            PermissionEnum::PROJECT_UPDATE,
            PermissionEnum::INVOICE_VIEW,
            PermissionEnum::PRODUCT_VIEW,
            PermissionEnum::SERVICE_VIEW,
        ]);
    }

    /**
     * @return Collection<int, PermissionEnum>
     */
    private static function customerPermissions(): iterable
    {
        return collect([
            PermissionEnum::CUSTOMER_VIEW,
            PermissionEnum::PROJECT_VIEW,
            PermissionEnum::PROJECT_UPDATE,
            PermissionEnum::INVOICE_VIEW,
            PermissionEnum::PRODUCT_VIEW,
            PermissionEnum::SERVICE_VIEW,
        ]);
    }
}
