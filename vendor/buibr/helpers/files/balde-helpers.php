<?php

if (!function_exists('my_route_active')) {
    /**
     * @param string $route
     * @param string $active
     * @param string|null $notActive
     *
     * @return string|null
     */
    function my_route_active(string $route, string $active = 'active', string $notActive = null)
    {
        return \Illuminate\Support\Facades\Request::routeIs($route) ? $active : ($notActive ? $notActive : null);
    }
}

if (!function_exists('my_date_localized')) {
    function my_date_localized(DateTimeInterface $date = null): string
    {
        return optional($date)->formatLocalized('%A, %d %b %Y') ?? "";
    }
}

if (!function_exists('my_column_sort_link')) {
    function my_column_sort_link($value, $key = 'sort')
    {
        if (!request()->input($key, null)) {
            return \Illuminate\Support\Facades\Request::fullUrlWithQuery(['sort' => $value, $key]);
        }

        $value = request()->input($key) === $value ? "-$value" : $value;

        return \Illuminate\Support\Facades\Request::fullUrlWithQuery(['sort' => $value]);
    }
}
