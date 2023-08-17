<?php

namespace Bi\Helpers\Traits\Enum;

trait RandomableEnumTrait
{
    public static function random() : self
    {
        $randomId = array_rand(self::cases(), 1);
        return self::cases()[$randomId];
    }
}
