<?php

if (!function_exists('public_path')) {
    function public_path($path = null)
    {
        return rtrim(app()->basePath('public/' . $path), '/');
    }
}

if (!function_exists('pathResolve')) {
    function pathResolve(string ...$paths): string
    {
        return implode(DIRECTORY_SEPARATOR, $paths);
    }
}

if (!function_exists('randomString')) {
    function randomString(): string
    {
        return md5(time() . rand(0, 9999));
    }
}

