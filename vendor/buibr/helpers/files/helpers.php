<?php

use Illuminate\Support\Str;

if (!function_exists('my_snake_to_title')) {
    /**
     * @param $value
     *
     * @return string
     */
    function my_snake_to_title($value)
    {
        return Str::title(str_replace('_', ' ', $value));
    }

    ;
}

if (!function_exists('my_camel_to_title')) {
    /**
     * @param $camelStr
     *
     * @return string|string[]|null
     */
    function my_camel_to_title($camelStr)
    {
        $intermediate = preg_replace('/(?!^)([[:upper:]][[:lower:]]+)/', ' $0', $camelStr);
        return preg_replace('/(?!^)([[:lower:]])([[:upper:]])/', '$1 $2', $intermediate);
    }
}

if (!function_exists('my_date_format')) {
    function my_date_format($date = null, string $format = 'Y-m-d H:i:s'): string
    {
        return optional($date)->format($format) ?? "";
    }
}

if (!function_exists('my_format_price')) {
    /**
     * @param        $value
     * @param string $currency
     * @param string $space
     *
     * @return string
     */
    function my_format_price($value, $currency = '€', $space = ' ')
    {
        return trim(html_entity_decode($currency, ENT_COMPAT, 'UTF-8') . $space . number_format($value, 2, ',', '.'));
    }
}

if (!function_exists('my_is_enum')) {

    /**
     * Check variable if its enum or not.
     * This is due to no native method in php to check for enum type.
     *
     * @param mixed $value
     * @return bool
     * @throws ReflectionException
     */
    function my_is_enum(mixed $value): bool
    {
        $reflection = new ReflectionClass($value);
        return $reflection->isEnum();
    }
}

