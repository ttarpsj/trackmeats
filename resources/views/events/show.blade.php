{{-- The single-event page body. Content lives in config/events.php. --}}
<section class="hero" aria-labelledby="event-title">
    <video class="hero-photo" autoplay loop muted playsinline preload="metadata" poster="{{ site_url($event['hero_image']) }}" aria-hidden="true">
        <source src="{{ site_url('videos/trackmeats-hero.mp4') }}" type="video/mp4">
        <img src="{{ site_url($event['hero_image']) }}" alt="">
    </video>
    <div class="hero-shade" aria-hidden="true"></div>
    <div class="hero-content shell">
        <p class="eyebrow hero-kicker">track & field · Amateurs & Professionals</p>
        <h1 id="event-title">@foreach ($event['name_lines'] as $line)<span>{{ $line }}</span>@endforeach</h1>
        <div class="hero-meta"><p>Every Friday Night</p><span aria-hidden="true">/</span><p>Jun 4th - Aug 30th</p></div>
        <a class="hero-cta" href="#information">Find your place on the line <span aria-hidden="true">↗</span></a>
    </div>
    <div class="hero-bottom shell">
        <img class="hero-label" src="{{ site_url('images/worldathleticslabel.svg') }}" alt="World Athletics label">
        <div class="hero-bottom-meta">
            <span>Fictional event · Demo edition</span>
            <a href="#about" aria-label="Discover the meats">↓</a>
        </div>
    </div>
</section>

<section class="intro section-light" id="about" aria-labelledby="intro-title">
    <div class="shell">
        <div class="section-overline"><p class="eyebrow">01 / The Meats</p><p class="eyebrow">Fridays From June–August · Around the Nation</p></div>
        <h2 id="intro-title">@foreach ($event['intro_heading'] as $line)<span>{{ $line }}</span>@endforeach</h2>
        <div class="intro-copy"><p class="intro-lead">{{ $event['intro_lead'] }}</p><div>@foreach ($event['intro'] as $paragraph)<p>{{ $paragraph }}</p>@endforeach<p class="intro-lead">{{ $event['intro_closing'] }}</p></div></div>
        <div class="action-strip"><a href="{{ $event['registration_url'] ?? '#entry' }}">Register <span>↗</span></a><a href="{{ $event['tickets_url'] ?? '#entry' }}">Watch <span>↗</span></a><a href="{{ $event['results_url'] ?? '#results' }}">Results <span>↗</span></a></div>
        <p class="demo-note">{{ $event['demo_notice'] }}</p>
    </div>
</section>

<section class="schedule section-dark" id="schedule" aria-labelledby="schedule-title">
    <div class="shell schedule-layout">
        <div class="section-heading"><p class="eyebrow">02 / On the clock</p><h2 id="schedule-title">One track.<br> All in.</h2><p>{{ $event['schedule_note'] }}</p><span class="vertical-caption">The competition schedule</span></div>
        <div class="schedule-content" data-schedule-cities>
            <div class="schedule-city-selector" role="group" aria-label="Meet city">
                <button type="button" class="schedule-city-control" data-schedule-city-previous aria-label="Previous city">←</button>
                <p class="schedule-city-name" data-schedule-city-name aria-live="polite">{{ $event['meet_locations']['chicago']['label'] }}</p>
                <button type="button" class="schedule-city-control" data-schedule-city-next aria-label="Next city">→</button>
            </div>
            @foreach ($event['meet_locations'] as $city => $meet)
                <div class="schedule-city" id="schedule-city-{{ $city }}" data-city-name="{{ $meet['label'] }}" data-tabs @if (!$loop->first) hidden @endif>
                    <div class="schedule-tabs" role="tablist" aria-label="{{ $meet['label'] }} competition schedule">
                        @foreach (['amateur' => 'Amateur', 'elite' => 'Elite'] as $division => $label)
                            <button type="button" id="schedule-tab-{{ $city }}-{{ $division }}" role="tab" aria-selected="{{ $division === 'elite' ? 'true' : 'false' }}" aria-controls="schedule-{{ $city }}-{{ $division }}" tabindex="{{ $division === 'elite' ? '0' : '-1' }}">{{ $label }}</button>
                        @endforeach
                    </div>
                    @foreach ($meet['schedule'] as $division => $races)
                        <div id="schedule-{{ $city }}-{{ $division }}" role="tabpanel" aria-labelledby="schedule-tab-{{ $city }}-{{ $division }}" tabindex="0" @if ($division !== 'elite') hidden @endif>
                            <p class="session-label">{{ $division === 'amateur' ? $event['opening_events_session'] : $meet['sessions'][$division] }} <span>Demo timetable</span></p>
                            <table class="timetable"><caption class="sr-only">{{ $meet['label'] }} {{ ucfirst($division) }} competition timetable — illustrative times</caption><thead><tr><th scope="col">Start</th><th scope="col">Discipline</th><th scope="col">Category / Round</th><th scope="col" class="race-starting-list-heading">Starting list</th></tr></thead><tbody>
                            @foreach ($division === 'amateur' ? $event['opening_events'] : $races as $race)
                                <tr @if ($division === 'amateur') class="amateur-row" @endif><th scope="row" class="race-time">{{ $race['time'] }}</th><td class="race-name">{{ $race['event'] }}@if ($division === 'amateur' && !empty($race['note']))<small class="race-note">{{ $race['note'] }}</small>@endif</td><td class="race-detail">{{ $race['division'] }}@if (!empty($race['heat']))<span>{{ $race['heat'] }}</span>@endif @if ($division !== 'amateur' && !empty($race['note']))<small>{{ $race['note'] }}</small>@endif</td><td class="race-starting-list"><button type="button" data-starting-list-toggle aria-label="Starting list for {{ $race['event'] }} {{ $race['heat'] ?? '' }}" aria-pressed="false"><span aria-hidden="true">›</span></button></td></tr>
                            @endforeach
                            </tbody></table>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</section>

<figure class="race-image"><img src="{{ site_url('images/trackmeats-banner.jpg') }}" alt="Spectators lining an outdoor track at night." width="1672" height="941" loading="lazy"><figcaption><span>Every second has a story.</span></figcaption></figure>

<section class="information section-light" id="information" aria-labelledby="information-title">
    <div class="shell">
        <div class="section-overline"><p class="eyebrow">03 / Before the gun</p><p class="eyebrow">The details make the difference</p></div>
        <h2 class="section-title" id="information-title">Know the meats.</h2>
        <div class="information-layout" data-tabs data-information>
            <div class="info-mobile-navigation">
                <button type="button" class="info-mobile-control" data-information-previous aria-label="Previous event information">←</button>
                <div class="info-navigation" role="tablist" aria-label="Event information" aria-orientation="vertical">
                    @foreach ($event['information'] as $key => $info)
                        <button type="button" id="info-tab-{{ $key }}" role="tab" aria-controls="info-{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" tabindex="{{ $loop->first ? '0' : '-1' }}"><span class="info-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><span>{{ $info['label'] }}</span><span class="info-arrow" aria-hidden="true">↗</span></button>
                    @endforeach
                </div>
                <button type="button" class="info-mobile-control" data-information-next aria-label="Next event information">→</button>
            </div>
            <div class="info-panels">
                @foreach ($event['information'] as $key => $info)
                    <article id="info-{{ $key }}" role="tabpanel" aria-labelledby="info-tab-{{ $key }}" tabindex="0" @if (!$loop->first) hidden @endif>
                        <p class="eyebrow">{{ $info['eyebrow'] }}</p><h3>{{ $info['title'] }}</h3>
                        @foreach ($info['paragraphs'] ?? [] as $paragraph)<p>{{ $paragraph }}</p>@endforeach
                        @if (!empty($info['facts']))<dl class="info-facts">@foreach ($info['facts'] as $label => $value)<div><dt>{{ $label }}</dt><dd>{{ $value }}</dd></div>@endforeach</dl>@endif
                        @if (!empty($info['items']))<ol class="info-list">@foreach ($info['items'] as $item)<li>{{ $item }}</li>@endforeach</ol>@endif
                        @if (!empty($info['entries']))<ul class="entry-list">@foreach ($info['entries'] as $entry)<li><strong>{{ $entry['name'] }}</strong><span>{{ $entry['discipline'] }}</span><small>{{ $entry['status'] }}</small></li>@endforeach</ul>@endif
                        @foreach ($info['faqs'] ?? [] as $faq)<details class="faq"><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach
                        @if (!empty($info['link']))<a class="text-link" href="{{ $info['link']['href'] }}">{{ $info['link']['label'] }} ↗</a>@endif
                    </article>
                @endforeach
            </div>
        </div>
        <div class="entry-status" id="entry"><div><p class="eyebrow">Your place on the line</p><h3>See you at the start.</h3></div><div><p>This is a fictional event showcase. Registration and ticket sales are not open.</p><div class="entry-actions">@if ($event['registration_url'])<a class="text-link" href="{{ $event['registration_url'] }}">Register ↗</a>@else<span>Registration · Open 1 May 2027</span>@endif @if ($event['tickets_url'])<a class="text-link" href="{{ $event['tickets_url'] }}">Watch ↗</a>@else<span>Watch · Free Stream on YoutTube / Visit the Venue</span>@endif</div></div></div>
    </div>
</section>

@if (!empty($event['merchandise']))
<section class="merchandise-section section-light" id="merchandise" aria-labelledby="merchandise-title">
    <div class="shell">
        <div class="section-overline"><p class="eyebrow">04 / Merchandise</p><p class="eyebrow">Limited event editions</p></div>
        <h2 class="section-title" id="merchandise-title">{{ $event['merchandise']['title'] }}</h2>
        <div class="merchandise">
            @foreach ($event['merchandise']['paragraphs'] as $paragraph)<p>{{ $paragraph }}</p>@endforeach
            <div class="merchandise-carousel" data-merchandise-carousel>
                <div class="merchandise-viewport" data-merchandise-viewport>
                    @foreach ($event['merchandise']['images'] as $image)<figure class="merchandise-slide"><img src="{{ site_url($image['path']) }}" alt="{{ $image['alt'] }}" width="1024" height="1280" loading="lazy"></figure>@endforeach
                </div>
                <div class="merchandise-controls"><button type="button" data-merchandise-previous aria-label="Previous merchandise image">←</button><button type="button" data-merchandise-next aria-label="Next merchandise image">→</button></div>
            </div>
        </div>
    </div>
</section>
@endif

<section class="results section-light" id="results" aria-labelledby="results-title">
    <div class="shell results-layout"><div><p class="eyebrow">05 / The archive</p><h2 class="section-title" id="results-title">Past the<br>finish line.</h2><p class="muted">Results &amp; Records. Sample editions. Fictional performances.<br>No official records or verified results.</p></div><div class="archive">@foreach ($event['past_results'] as $edition)<div class="archive-entry"><span class="archive-year">{{ $edition['year'] }}</span><span>{{ $edition['summary'] }}<small>Demo results</small></span></div>@endforeach</div></div>
</section>

@if (!empty($event['archive_gallery']))
<section class="gallery-section section-light" id="gallery" aria-labelledby="archive-gallery-title">
    <div class="shell archive-gallery-section">
        <p class="eyebrow">06 / Gallery</p>
        <h2 id="archive-gallery-title">{{ $event['archive_gallery']['title'] }}</h2>
        <div class="archive-gallery" aria-label="Visual archive">
            @foreach ($event['archive_gallery']['tiles'] as $tile)
                <figure class="archive-gallery-tile" data-archive-gallery-tile>
                    @if (!empty($tile['media']))
                        @foreach ($tile['media'] as $media)<div class="archive-gallery-layer @if ($loop->first) is-active @endif"><img src="{{ site_url($media['path']) }}" alt="{{ $media['alt'] }}" loading="lazy"></div>@endforeach
                    @else
                        @foreach ($event['archive_gallery']['placeholder_colors'] as $color)<span class="archive-gallery-layer archive-gallery-placeholder @if ($loop->first) is-active @endif" style="background-color:{{ $color }}" aria-hidden="true"></span>@endforeach
                    @endif
                </figure>
            @endforeach
        </div>
    </div>
</section>
@endif
