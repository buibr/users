<?php

namespace Bi\Helpers\Traits\Enum;

trait ArrayableEnumTrait
{
    public static function toArray()
    {
        return array_map(fn(self $item) => isset($item->value) ? $item->value : $item->name, self::cases());
    }
}
