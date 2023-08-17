<?php

use Bi\Users\User;
use Bi\Users\Enums\RoleEnum;
use Bi\Users\Enums\PermissionEnum;
use Bi\Users\Enums\RolePermissions;

class PermissionTest extends \PHPUnit\Framework\TestCase
{
    public function testFile()
    {
        $links = RolePermissions::toArray();

        self::assertSame($links[RoleEnum::MASTER->name], RolePermissions::permissions(RoleEnum::MASTER));
    }

}
