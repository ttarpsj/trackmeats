<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $event['description'] }} Fictional event portfolio demonstration.">
    <meta name="theme-color" content="#111210">
    <title>{{ $event['name'] }} — {{ $event['brand'] }}</title>
    <link rel="icon" href="{{ site_url('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @if (config('site.exporting'))
        @php($manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true, flags: JSON_THROW_ON_ERROR))
        <link rel="stylesheet" href="{{ site_url('build/'.$manifest['resources/css/app.css']['file']) }}">
        <script type="module" src="{{ site_url('build/'.$manifest['resources/js/app.js']['file']) }}"></script>
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to content</a>
    <header class="site-header" id="top">
        <div class="header-top shell">
            <div class="header-socials"><x-social-links :socials="$event['socials']" /></div>
            <a class="wordmark" href="{{ site_url() }}" aria-label="{{ $event['brand'] }} home"><img class="wordmark-logo" src="{{ site_url('images/trackmeats.svg') }}" alt=""></a>
            <div class="header-actions">
                <a class="button button-outline" href="{{ $event['registration_url'] ?? '#entry' }}">Register</a>
                <a class="button button-outline" href="{{ $event['tickets_url'] ?? '#entry' }}">Tickets</a>
            </div>
            <button class="menu-toggle" type="button" data-menu-button aria-controls="mobile-navigation" aria-expanded="false"><span data-menu-label>Menu</span><span class="menu-lines" aria-hidden="true"></span></button>
        </div>
        <nav class="desktop-nav" aria-label="Primary navigation">
            @foreach ($event['navigation'] as $id => $label)<a href="#{{ $id }}">{{ $label }}</a>@endforeach
        </nav>
        <nav id="mobile-navigation" class="mobile-nav" aria-label="Mobile navigation" hidden>
            @foreach ($event['navigation'] as $id => $label)<a href="#{{ $id }}">{{ $label }} <span aria-hidden="true">↗</span></a>@endforeach
            <div class="mobile-actions"><a class="button" href="{{ $event['registration_url'] ?? '#entry' }}">Register</a><a class="button button-outline" href="{{ $event['tickets_url'] ?? '#entry' }}">Tickets</a></div>
            <x-social-links :socials="$event['socials']" />
        </nav>
    </header>
    <main id="main-content">@yield('content')</main>
    <footer class="site-footer" id="contact">
        <div class="shell footer-top">
            <div>
                <p class="eyebrow">Stay close to the track</p>
                <h2>Good things.<br>In your inbox.</h2>
                <p>Race announcements, field notes and the stories between.</p>
                @if ($event['newsletter_url'])
                    <a class="button" href="{{ $event['newsletter_url'] }}">Join the mailing list ↗</a>
                @else
                    <div class="newsletter-placeholder"><span>Newsletter coming soon</span><span aria-hidden="true">↗</span></div>
                    <p class="fine-print">No signup service is connected. We do not collect email addresses.</p>
                @endif
            </div>
            <div class="footer-links"><p class="eyebrow">{{ $event['name'] }}</p>@foreach ($event['navigation'] as $id => $label)<a href="#{{ $id }}">{{ $label }}</a>@endforeach</div>
            <div id="social-status"><p class="eyebrow">Around the track</p><x-social-links :socials="$event['socials']" /><p class="fine-print">Social channels are placeholders until official profiles are added.</p><p class="organizer">{{ $event['organizer'] }}</p>@if ($event['contact_email'])<a href="mailto:{{ $event['contact_email'] }}">{{ $event['contact_email'] }}</a>@else<p class="fine-print">Organizer contact to be announced.</p>@endif</div>
        </div>
        <div class="shell footer-wordmark" aria-hidden="true">{{ $event['brand'] }}<span>↗</span></div>
        <div class="shell footer-bottom"><p>© {{ date('Y') }} {{ $event['brand'] }} · Fictional event / Portfolio concept</p><div><a href="#info-terms" data-info-link="terms">Terms & conditions</a><a href="#info-disclaimer" data-info-link="disclaimer">Disclaimer</a><a href="#top">Back to top ↑</a></div></div>
    </footer>
</body>
</html>
