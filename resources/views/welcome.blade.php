@extends('layouts.app')

@section('title', 'Track Meats — Where Speed Meets Culture')
@section('meta_description', 'Four focused track events. One independent series built around speed, competition, and culture.')

@section('content')
    <section class="relative isolate flex min-h-[calc(100svh-4.5rem)] items-end overflow-hidden border-b border-neutral-800">
        <div class="absolute inset-0 -z-20 bg-black"></div>
        <div class="absolute inset-0 -z-10 opacity-25" aria-hidden="true" style="background-image: repeating-linear-gradient(105deg, transparent 0, transparent 10vw, #737373 10vw, #737373 calc(10vw + 1px));"></div>
        <div class="absolute -right-[10%] top-[14%] -z-10 h-[70%] w-[55%] rotate-[-12deg] border border-neutral-700 opacity-60" aria-hidden="true"></div>

        <div class="mx-auto grid w-full max-w-[96rem] gap-10 px-5 py-16 sm:px-8 sm:py-20 lg:grid-cols-[1fr_auto] lg:items-end lg:px-12 lg:py-24">
            <div>
                <p class="mb-6 text-[0.68rem] font-bold uppercase tracking-[0.28em] text-neutral-400">Independent track event series / 2027</p>
                <h1 class="max-w-6xl text-[clamp(4.25rem,12vw,11.5rem)] font-black uppercase leading-[0.76] tracking-[-0.075em]">
                    Where Speed<br><span class="text-neutral-500">Meets Culture</span>
                </h1>
                <p class="mt-8 max-w-xl text-base leading-7 text-neutral-400 sm:text-lg">Four meets. Serious racing. A clean stage for athletes, spectators, and the moments that move the sport forward.</p>
            </div>

            <a href="#events" class="inline-flex min-h-14 w-fit items-center gap-8 border border-white bg-white px-6 text-xs font-black uppercase tracking-[0.17em] text-black transition hover:bg-black hover:text-white lg:mb-2">
                Explore events <span aria-hidden="true">↓</span>
            </a>
        </div>
    </section>

    <section id="events" class="mx-auto max-w-[96rem] px-5 py-20 sm:px-8 lg:px-12 lg:py-28">
        <div class="mb-12 grid gap-6 border-b border-neutral-800 pb-8 md:grid-cols-[1fr_2fr] md:items-end">
            <p class="text-[0.68rem] font-bold uppercase tracking-[0.22em] text-neutral-500">01 / The series</p>
            <div class="md:text-right">
                <h2 class="text-[clamp(2.8rem,7vw,7rem)] font-black uppercase leading-[0.82] tracking-[-0.065em]">Four ways<br>to race.</h2>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($events as $event)
                <x-event-card
                    :event="$event"
                    :href="site_url($event['slug'])"
                    :image-url="site_url($event['hero_image'])"
                    :index="str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT)"
                />
            @endforeach
        </div>
    </section>

    <section class="border-y border-neutral-800 bg-white text-black">
        <div class="mx-auto grid max-w-[96rem] gap-10 px-5 py-16 sm:px-8 md:grid-cols-2 md:items-end lg:px-12 lg:py-24">
            <h2 class="text-[clamp(3rem,8vw,8rem)] font-black uppercase leading-[0.82] tracking-[-0.07em]">Built for<br>the clock.</h2>
            <div class="max-w-lg md:justify-self-end">
                <p class="text-lg font-semibold leading-8">Track Meats is a static showcase for a new series of athlete-first events. Dates, entries, schedules, broadcasts, and results will appear here as each meet takes shape.</p>
                <p class="mt-8 text-[0.68rem] font-bold uppercase tracking-[0.2em] text-neutral-500">San Diego / New York / More to come</p>
            </div>
        </div>
    </section>
@endsection
