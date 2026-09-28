{{-- The single-event page body. Content lives in config/events.php. --}}
<section class="hero" aria-labelledby="event-title">
    <img class="hero-photo" src="{{ site_url($event['hero_image']) }}" alt="{{ $event['hero_alt'] }}" width="1672" height="941" fetchpriority="high">
    <div class="hero-shade" aria-hidden="true"></div>
    <div class="hero-content shell">
        <p class="eyebrow hero-kicker">track & field · Amateurs & Professionals</p>
        <h1 id="event-title">@foreach ($event['name_lines'] as $line)<span>{{ $line }}</span>@endforeach</h1>
        <div class="hero-meta"><p>{{ $event['date'] }}</p><span aria-hidden="true">/</span><p>{{ $event['venue'] }}</p></div>
        <a class="hero-cta" href="#information">Find your place on the line <span aria-hidden="true">↗</span></a>
    </div>
    <div class="hero-bottom shell"><p>{{ $event['tagline'] }}</p><span>Fictional event · Demo edition</span><a href="#about" aria-label="Discover the meet">↓</a></div>
</section>

<section class="intro section-light" id="about" aria-labelledby="intro-title">
    <div class="shell">
        <div class="section-overline"><p class="eyebrow">01 / The meet</p><p class="eyebrow">{{ $event['date'] }} · Demonstration</p></div>
        <h2 id="intro-title">@foreach ($event['intro_heading'] as $line)<span>{{ $line }}</span>@endforeach</h2>
        <div class="intro-copy"><p class="intro-lead">{{ $event['description'] }}</p><div>@foreach ($event['intro'] as $paragraph)<p>{{ $paragraph }}</p>@endforeach</div></div>
        <div class="action-strip"><a href="{{ $event['registration_url'] ?? '#entry' }}">Register <span>↗</span></a><a href="{{ $event['tickets_url'] ?? '#entry' }}">Watch <span>↗</span></a><a href="{{ $event['results_url'] ?? '#results' }}">Results <span>↗</span></a></div>
        <p class="demo-note">{{ $event['demo_notice'] }}</p>
    </div>
</section>

<section class="schedule section-dark" id="schedule" aria-labelledby="schedule-title">
    <div class="shell schedule-layout">
        <div class="section-heading"><p class="eyebrow">02 / On the clock</p><h2 id="schedule-title">One track.<br> All in.</h2><p>{{ $event['schedule_note'] }}</p><span class="vertical-caption">The competition schedule</span></div>
        <div class="schedule-content" data-tabs>
            <div class="schedule-tabs" role="tablist" aria-label="Competition schedule">
                @foreach (['amateur' => 'Amateur', 'elite' => 'Elite'] as $division => $label)
                    <button type="button" id="schedule-tab-{{ $division }}" role="tab" aria-selected="{{ $division === 'elite' ? 'true' : 'false' }}" aria-controls="schedule-{{ $division }}" tabindex="{{ $division === 'elite' ? '0' : '-1' }}">{{ $label }}</button>
                @endforeach
            </div>
            @foreach ($event['schedule'] as $division => $races)
                <div id="schedule-{{ $division }}" role="tabpanel" aria-labelledby="schedule-tab-{{ $division }}" tabindex="0" @if ($division !== 'elite') hidden @endif>
                    <p class="session-label">{{ $event['sessions'][$division] }} <span>Demo timetable</span></p>
                    <table class="timetable"><caption class="sr-only">{{ ucfirst($division) }} competition timetable — illustrative times</caption><thead><tr><th scope="col">Start</th><th scope="col">Discipline</th><th scope="col">Category / Round</th></tr></thead><tbody>
                    @foreach ($races as $race)
                        <tr><th scope="row" class="race-time">{{ $race['time'] }}</th><td class="race-name">{{ $race['event'] }}</td><td class="race-detail">{{ $race['division'] }}@if (!empty($race['heat']))<span>{{ $race['heat'] }}</span>@endif @if (!empty($race['note']))<small>{{ $race['note'] }}</small>@endif</td></tr>
                    @endforeach
                    </tbody></table>
                </div>
            @endforeach
        </div>
    </div>
</section>

<figure class="race-image"><img src="{{ site_url($event['support_image']) }}" alt="{{ $event['support_alt'] }}" width="1672" height="941" loading="lazy"><figcaption><span>Every second has a story.</span><span>Concept imagery / AI-generated</span></figcaption></figure>

<section class="information section-light" id="information" aria-labelledby="information-title">
    <div class="shell">
        <div class="section-overline"><p class="eyebrow">03 / Before the gun</p><p class="eyebrow">The details make the difference</p></div>
        <h2 class="section-title" id="information-title">Know the meet.</h2>
        <div class="information-layout" data-tabs data-information>
            <div class="info-navigation" role="tablist" aria-label="Event information" aria-orientation="vertical">
                @foreach ($event['information'] as $key => $info)
                    <button type="button" id="info-tab-{{ $key }}" role="tab" aria-controls="info-{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" tabindex="{{ $loop->first ? '0' : '-1' }}"><span class="info-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><span>{{ $info['label'] }}</span><span class="info-arrow" aria-hidden="true">↗</span></button>
                @endforeach
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
        <div class="entry-status" id="entry"><div><p class="eyebrow">Your place on the line</p><h3>See you at the start.</h3></div><div><p>This is a fictional event showcase. Registration and ticket sales are not open.</p><div class="entry-actions">@if ($event['registration_url'])<a class="text-link" href="{{ $event['registration_url'] }}">Register ↗</a>@else<span>Registration · Not open</span>@endif @if ($event['tickets_url'])<a class="text-link" href="{{ $event['tickets_url'] }}">Watch ↗</a>@else<span>Watch · Not on sale</span>@endif</div></div></div>
    </div>
</section>

<section class="results section-light" id="results" aria-labelledby="results-title"><div class="shell results-layout"><div><p class="eyebrow">04 / The archive</p><h2 class="section-title" id="results-title">Past the<br>finish line.</h2><p class="muted">Sample editions. Fictional performances.<br>No official records or verified results.</p></div><div class="archive">@foreach ($event['past_results'] as $edition)<details><summary><span class="archive-year">{{ $edition['year'] }}</span><span>{{ $edition['summary'] }}<small>Demo results</small></span><span class="plus" aria-hidden="true">+</span></summary><div class="archive-content"><p class="fine-print">Illustrative winners — all names and times are fictional.</p><table><caption class="sr-only">{{ $edition['year'] }} demonstration results</caption><thead><tr><th scope="col">Race</th><th scope="col">Athlete</th><th scope="col">Time</th></tr></thead><tbody>@foreach ($edition['rows'] as $result)<tr><th scope="row">{{ $result['race'] }}</th><td>{{ $result['athlete'] }}</td><td>{{ $result['time'] }}</td></tr>@endforeach</tbody></table></div></details>@endforeach</div></div></section>