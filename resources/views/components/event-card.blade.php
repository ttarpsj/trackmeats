@props(['event', 'href', 'imageUrl', 'index'])

<article class="group relative flex min-h-[32rem] flex-col overflow-hidden border border-neutral-800 bg-neutral-950">
    <img
        src="{{ $imageUrl }}"
        alt="Abstract placeholder artwork for {{ $event['name'] }}"
        class="absolute inset-0 h-full w-full object-cover opacity-55 transition duration-700 group-hover:scale-[1.03] group-hover:opacity-70"
        loading="lazy"
        width="1200"
        height="1500"
    >
    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/45 to-transparent"></div>

    <div class="relative flex h-full flex-1 flex-col justify-between p-6 sm:p-8">
        <div class="flex items-start justify-between gap-6">
            <p class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-neutral-300">Event {{ $index }}</p>
            <p class="max-w-36 text-right text-[0.65rem] font-bold uppercase tracking-[0.14em] text-neutral-300">{{ $event['location'] }}</p>
        </div>

        <div class="mt-44">
            <p class="mb-4 text-xs font-bold uppercase tracking-[0.15em] text-neutral-300">{{ $event['date'] }}</p>
            <h3 class="text-[clamp(2.2rem,4vw,4.5rem)] font-black uppercase leading-[0.86] tracking-[-0.065em]">{{ $event['name'] }}</h3>
            <p class="mt-5 max-w-md text-sm leading-6 text-neutral-300">{{ $event['description'] }}</p>
            <a href="{{ $href }}" class="mt-8 inline-flex min-h-12 items-center gap-3 border border-white px-5 text-xs font-bold uppercase tracking-[0.16em] transition hover:bg-white hover:text-black">
                Event details <span aria-hidden="true">↗</span>
            </a>
        </div>
    </div>
</article>
