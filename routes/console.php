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

    if (! File::isFile(public_path('build/manifest.json'))) {
        $this->error('Build the frontend assets with npm run build before exporting.');

        return 1;
    }

    config(['site.base_path' => $basePath, 'site.exporting' => true]);

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

    // Static hosts cannot execute Laravel's compatibility redirects.
    foreach (config('site.legacy_paths') as $slug) {
        $destination = $outputPath.DIRECTORY_SEPARATOR.$slug;
        File::ensureDirectoryExists($destination);
        $url = htmlspecialchars(site_url(), ENT_QUOTES, 'UTF-8');
        File::put($destination.DIRECTORY_SEPARATOR.'index.html', '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta http-equiv="refresh" content="0;url='.$url.'"><title>Event page moved</title></head><body><p>This site now presents one event. <a href="'.$url.'">Visit the event homepage</a>.</p></body></html>');
    }

    File::ensureDirectoryExists($outputPath.DIRECTORY_SEPARATOR.'downloads');
    File::put($outputPath.DIRECTORY_SEPARATOR.'downloads'.DIRECTORY_SEPARATOR.'press-note.txt', view('events.press-note', ['event' => config('events')])->render());

    foreach (['images', 'videos', 'build'] as $directory) {
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
