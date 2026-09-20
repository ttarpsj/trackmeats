<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['events' => config('events')]);
})->name('home');

Route::get('/{event}', function (string $event) {
    abort_unless(array_key_exists($event, config('events')), 404);

    return view('events.show', [
        'event' => config("events.{$event}"),
    ]);
})->whereIn('event', array_keys(config('events')))->name('events.show');
