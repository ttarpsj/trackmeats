@extends('layouts.app')

@section('title', $event['name'].' — Track Meats')
@section('meta_description', $event['description'])

@section('content')
    @php
        $actions = [
            ['label' => 'Register', 'url' => $event['registration_url']],
            ['label' => 'Tickets', 'url' => $event['tickets_url']],
            ['label' => 'Watch', 'url' => $event['watch_url']],
            ['label' => 'Results', 'url' => $event['results_url']],
        ];
        $visibleActions = array_filter($actions, fn ($action) => filled($action['url']));
    @endphp

    <section class="event-hero relative min-h-[72svh] overflow-hidden border-b border-neutral-800">
        <img src="{{ site_url($event['hero_image']) }}" alt="Abstract placeholder artwork for {{ $event['name'] }}" class="absolute inset-0 h-full w-full object-cover" width="1600" height="1000">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-black/10"></div>
        <div class="relative mx-auto flex min-h-[72svh] max-w-[96rem] flex-col justify-between px-5 py-8 sm:px-8 lg:px-12 lg:py-12">
            <div class="flex items-center justify-between text-[0.65rem] font-bold uppercase tracking-[0.2em] text-neutral-300">
                <p>Track Meats / Event</p>
                <p>{{ $event['date'] }}</p>
            </div>
            <div>
                <p class="mb-5 max-w-md text-sm font-semibold uppercase tracking-[0.12em] text-neutral-200">{{ $event['tagline'] }}</p>
                <h1 class="max-w-7xl text-[clamp(4.3rem,13vw,12rem)] font-black uppercase leading-[0.75] tracking-[-0.075em]">{{ $event['name'] }}</h1>
            </div>
        </div>
    </section>

    <section class="event-introduction mx-auto max-w-[96rem] px-5 py-16 sm:px-8 lg:px-12 lg:py-24">
        <div class="grid gap-12 lg:grid-cols-[0.8fr_1.7fr]">
            <div class="space-y-7">
                <div class="border-t border-neutral-700 pt-3">
                    <p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-neutral-500">Date</p>
                    <p class="mt-2 text-sm font-bold uppercase">{{ $event['date'] }}</p>
                </div>
                <div class="border-t border-neutral-700 pt-3">
                    <p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-neutral-500">Location</p>
                    <p class="mt-2 text-sm font-bold uppercase">{{ $event['location'] }}</p>
                </div>
                <div class="border-t border-neutral-700 pt-3">
                    <p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-neutral-500">Venue</p>
                    <p class="mt-2 text-sm font-bold uppercase">{{ $event['venue'] }}</p>
                </div>
            </div>

            <div>
                <p class="text-[clamp(1.8rem,4vw,4.5rem)] font-bold leading-[1.04] tracking-[-0.045em]">{{ $event['description'] }}</p>

                @if (count($visibleActions))
                    <div class="mt-10 flex flex-wrap gap-3" aria-label="Event actions">
                        @foreach ($visibleActions as $action)
                            <a href="{{ $action['url'] }}" class="inline-flex min-h-12 items-center border border-white px-5 text-xs font-black uppercase tracking-[0.16em] transition hover:bg-white hover:text-black" target="_blank" rel="noopener noreferrer">
                                {{ $action['label'] }} ↗
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="mt-10 text-xs font-bold uppercase tracking-[0.16em] text-neutral-500">Registration and event links coming soon.</p>
                @endif
            </div>
        </div>
    </section>

    <section class="event-schedule border-y border-neutral-800 bg-neutral-950">
        <div class="mx-auto max-w-[96rem] px-5 py-16 sm:px-8 lg:px-12 lg:py-24">
            <div class="mb-10 flex items-end justify-between gap-6">
                <div>
                    <p class="mb-4 text-[0.65rem] font-bold uppercase tracking-[0.2em] text-neutral-500">Race day</p>
                    <h2 class="text-[clamp(3.2rem,8vw,8rem)] font-black uppercase leading-[0.8] tracking-[-0.07em]">Schedule</h2>
                </div>
                <p class="hidden text-right text-[0.65rem] font-bold uppercase tracking-[0.16em] text-neutral-500 sm:block">Provisional<br>subject to change</p>
            </div>

            <div class="border-t border-neutral-700">
                @foreach ($event['schedule'] as $item)
                    <div class="grid gap-3 border-b border-neutral-800 py-6 sm:grid-cols-[9rem_1fr_auto] sm:items-center">
                        <time class="text-sm font-black uppercase tracking-[0.1em]">{{ $item['time'] }}</time>
                        <p class="text-2xl font-black uppercase tracking-[-0.04em] sm:text-3xl">{{ $item['event'] }}</p>
                        <p class="text-[0.65rem] font-bold uppercase tracking-[0.16em] text-neutral-500 sm:text-right">{{ $item['division'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="event-information mx-auto max-w-[96rem] px-5 py-16 sm:px-8 lg:px-12 lg:py-24">
        <div class="grid gap-10 lg:grid-cols-[0.8fr_2fr]">
            <div>
                <p class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-neutral-500">Plan your day</p>
                <h2 class="mt-4 text-[clamp(2.7rem,5vw,5.5rem)] font-black uppercase leading-[0.85] tracking-[-0.06em]">Event<br>information</h2>
            </div>
            <div class="grid border-t border-neutral-700 md:grid-cols-2">
                @foreach ($event['additional_information'] as $item)
                    <article class="border-b border-neutral-800 py-8 md:px-7 md:odd:border-r md:first:pl-0">
                        <p class="text-xs font-black uppercase tracking-[0.17em]">{{ $item['title'] }}</p>
                        <p class="mt-5 text-sm leading-7 text-neutral-400">{{ $item['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="event-results border-t border-neutral-800 bg-white text-black">
        <div class="mx-auto max-w-[96rem] px-5 py-16 sm:px-8 lg:px-12 lg:py-24">
            <div class="grid gap-10 lg:grid-cols-[1fr_1.2fr] lg:items-start">
                <div>
                    <p class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-neutral-500">Archive</p>
                    <h2 class="mt-4 text-[clamp(3.2rem,7vw,7rem)] font-black uppercase leading-[0.82] tracking-[-0.07em]">Past<br>results</h2>
                </div>
                <div class="border-t border-black">
                    @forelse ($event['past_results'] as $result)
                        <div class="flex items-center justify-between border-b border-neutral-300 py-5">
                            <span class="text-3xl font-black tracking-[-0.04em]">{{ $result['year'] }}</span>
                            @if (filled($result['url']))
                                <a href="{{ $result['url'] }}" class="text-xs font-black uppercase tracking-[0.16em] hover:underline" target="_blank" rel="noopener noreferrer">View results ↗</a>
                            @else
                                <span class="text-[0.65rem] font-bold uppercase tracking-[0.16em] text-neutral-500">Link coming soon</span>
                            @endif
                        </div>
                    @empty
                        <p class="border-b border-neutral-300 py-5 text-sm text-neutral-600">Results will be posted after the first edition.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
