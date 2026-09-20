<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('site:export {--base-path= : Optional URL prefix for a GitHub project site}', function () {
    $basePath = trim((string) ($this->option('base-path') ?: config('site.base_path')), '/');
    $outputPath = base_path('dist');
    $routes = ['/' => 'index.html'];

    foreach (array_keys(config('events')) as $slug) {
        $routes['/'.$slug] = $slug.'/index.html';
    }

    config(['site.base_path' => $basePath]);

    if (File::isDirectory($outputPath)) {
        File::deleteDirectory($outputPath);
    }

    File::ensureDirectoryExists($outputPath);
    $kernel = app(Kernel::class);

    foreach ($routes as $uri => $destination) {
        $request = Request::create($uri);
        $response = $kernel->handle($request);

        if (! $response->isSuccessful()) {
            throw new RuntimeException("Unable to export {$uri}: HTTP {$response->getStatusCode()}");
        }

        $html = (string) $response->getContent();

        if (preg_match('/(?:localhost|127\.0\.0\.1|\.test(?:[\/:]|$))/i', $html)) {
            throw new RuntimeException("The exported page {$uri} contains a local development URL.");
        }

        $destinationPath = $outputPath.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $destination);
        File::ensureDirectoryExists(dirname($destinationPath));
        File::put($destinationPath, $html);
        $kernel->terminate($request, $response);
        $this->line("Exported {$uri}");
    }

    foreach (['images', 'build'] as $directory) {
        $source = public_path($directory);

        if (File::isDirectory($source)) {
            File::copyDirectory($source, $outputPath.DIRECTORY_SEPARATOR.$directory);
        }
    }

    foreach (['favicon.ico', 'robots.txt'] as $file) {
        if (File::isFile(public_path($file))) {
            File::copy(public_path($file), $outputPath.DIRECTORY_SEPARATOR.$file);
        }
    }

    File::put($outputPath.DIRECTORY_SEPARATOR.'.nojekyll', '');
    $prefix = $basePath === '' ? '/' : '/'.$basePath.'/';
    $this->info("Static site exported to dist for {$prefix}");
})->purpose('Export the public Laravel routes as a static website');
