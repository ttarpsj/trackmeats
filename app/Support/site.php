<?php

if (! function_exists('site_url')) {
    function site_url(string $path = ''): string
    {
        $basePath = trim((string) config('site.base_path', ''), '/');
        $path = trim($path, '/');
        $prefix = $basePath === '' ? '' : '/'.$basePath;

        return $prefix.'/'.($path === '' ? '' : $path);
    }
}
