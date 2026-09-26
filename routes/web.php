<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome', ['event' => config('events')]))->name('home');

Route::get('/downloads/press-note.txt', fn () => response(
    view('events.press-note', ['event' => config('events')])->render(),
    200,
    ['Content-Type' => 'text/plain; charset=UTF-8', 'Content-Disposition' => 'attachment; filename="press-note.txt"'],
))->name('press-note');

// Keep incoming bookmarks working without retaining separate event sites.
Route::get('/{event}', fn () => redirect(site_url(), 301))
    ->whereIn('event', config('site.legacy_paths'))
    ->name('events.show');
