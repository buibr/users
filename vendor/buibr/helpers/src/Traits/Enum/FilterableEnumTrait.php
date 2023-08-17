<?php

namespace Bi\Helpers\Traits\Enum;

trait FilterableEnumTrait
{
    public static function filter(array $enums = [])
    {
        return array_filter(self::cases(), fn (self $item) => !in_array($item, $enums));
    }
}
