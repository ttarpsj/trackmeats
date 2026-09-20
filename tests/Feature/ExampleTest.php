<?php

test('the homepage presents the complete event series', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Where Speed Meets Culture')
        ->assertSeeInOrder([
            'Balboa Classic',
            'Icahn Memorial',
            'M10KE',
            'La Jolla Games',
        ]);
});

test('each configured event has a public detail page', function (string $slug, string $name) {
    $this->get('/'.$slug)
        ->assertOk()
        ->assertSee($name)
        ->assertSee('Schedule')
        ->assertSeeInOrder(['Past', 'results']);
})->with([
    ['balboa-classic', 'Balboa Classic'],
    ['icahn-memorial', 'Icahn Memorial'],
    ['m10ke', 'M10KE'],
    ['la-jolla-games', 'La Jolla Games'],
]);

test('unknown event slugs return not found', function () {
    $this->get('/not-an-event')->assertNotFound();
});
