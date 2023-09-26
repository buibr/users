<?php

use Bi\Users\Enums\RoleEnum;
use PHPUnit\Framework\TestCase;
use Bi\Users\Enums\RolePermissions;

class PermissionTest extends TestCase
{
    public function testFile()
    {
        $links = RolePermissions::toArray();

        self::assertSame($links[RoleEnum::MASTER->name], RolePermissions::permissions(RoleEnum::MASTER));
    }

}
