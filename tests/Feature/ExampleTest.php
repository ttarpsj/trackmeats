<?php

test('the homepage presents exactly one fictional event', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Balboa Classic')
        ->assertSee('Fictional event')
        ->assertSee('Coastline Oval')
        ->assertDontSee('Icahn Memorial')
        ->assertDontSee('La Jolla Games')
        ->assertDontSee('M10KE')
        ->assertSee('id="schedule-elite"', false)
        ->assertSee('id="schedule-amateur"', false);
});

test('all twelve information categories are rendered accessibly', function () {
    $response = $this->get('/')->assertOk();
    expect(config('events.information'))->toHaveCount(12);
    foreach (config('events.information') as $key => $information) {
        $response->assertSee('id="info-tab-'.$key.'"', false)
            ->assertSee('aria-controls="info-'.$key.'"', false)
            ->assertSee('id="info-'.$key.'"', false)
            ->assertSee($information['label']);
    }
});

test('legacy bookmarks redirect to the single homepage', function (string $slug) {
    $this->get('/'.$slug)->assertStatus(301)->assertRedirect('/');
})->with(['balboa-classic', 'icahn-memorial', 'm10ke', 'la-jolla-games']);

test('unknown paths return not found', function () {
    $this->get('/not-an-event')->assertNotFound();
});

test('the concept press download uses editable event content', function () {
    $this->get('/downloads/press-note.txt')->assertOk()
        ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
        ->assertSee('FICTIONAL EVENT')
        ->assertSee(config('events.name'))
        ->assertSee(config('events.date'));
});

test('static rendering prefixes assets and preserves local section links', function () {
    config(['site.exporting' => true, 'site.base_path' => 'trackmeats']);
    $this->get('/')->assertOk()
        ->assertSee('/trackmeats/build/assets/', false)
        ->assertSee('/trackmeats/images/balboa/race-at-dusk.jpg', false)
        ->assertSee('/trackmeats/downloads/press-note.txt', false)
        ->assertSee('href="#schedule"', false)
        ->assertDontSee('cdn.jsdelivr.net')
        ->assertDontSee('localhost');
});

test('optional integrations are used only when configured', function () {
    config(['events.registration_url' => 'https://example.com/register', 'events.newsletter_url' => 'https://example.com/newsletter']);
    $this->get('/')->assertOk()
        ->assertSee('https://example.com/register', false)
        ->assertSee('https://example.com/newsletter', false)
        ->assertDontSee('No signup service is connected');
});
