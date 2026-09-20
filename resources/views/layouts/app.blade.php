<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('meta_description', 'Track Meats presents focused, high-energy track and field events.')">
        <meta name="theme-color" content="#000000">

        <title>@yield('title', 'Track Meats')</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

        <style type="text/tailwindcss">
            @theme {
                --font-sans: "Montserrat", ui-sans-serif, system-ui, sans-serif;
            }

            @layer base {
                :focus-visible {
                    outline: 2px solid white;
                    outline-offset: 4px;
                }

                ::selection {
                    background: white;
                    color: black;
                }
            }
        </style>

        @stack('head')
    </head>
    @php($navigationEvents = config('events'))
    <body class="min-h-screen bg-black font-sans text-white antialiased">
        <a href="#main-content" class="fixed left-4 top-4 z-[100] -translate-y-24 bg-white px-4 py-3 text-xs font-bold uppercase tracking-[0.18em] text-black transition focus:translate-y-0">
            Skip to content
        </a>

        <header class="sticky top-0 z-50 border-b border-neutral-800 bg-black/95 backdrop-blur">
            <div class="mx-auto flex h-18 max-w-[96rem] items-center justify-between px-5 sm:px-8 lg:px-12">
                <a href="{{ site_url() }}" class="text-lg font-black uppercase tracking-[-0.04em] sm:text-xl" aria-label="Track Meats home">
                    Track Meats<span class="text-neutral-500">.</span>
                </a>

                <nav class="hidden items-center gap-7 lg:flex" aria-label="Primary navigation">
                    @foreach ($navigationEvents as $navEvent)
                        <a href="{{ site_url($navEvent['slug']) }}" class="text-[0.7rem] font-bold uppercase tracking-[0.16em] text-neutral-400 transition hover:text-white">
                            {{ $navEvent['short_name'] }}
                        </a>
                    @endforeach
                    <a href="{{ site_url() }}#events" class="border border-white px-4 py-2 text-[0.7rem] font-bold uppercase tracking-[0.16em] transition hover:bg-white hover:text-black">
                        All events
                    </a>
                </nav>

                <button type="button" class="flex min-h-11 min-w-11 items-center justify-center border border-neutral-700 lg:hidden" data-menu-button aria-expanded="false" aria-controls="mobile-navigation">
                    <span class="sr-only">Open navigation</span>
                    <span class="flex w-5 flex-col gap-1.5" aria-hidden="true">
                        <span class="h-px w-full bg-white"></span>
                        <span class="h-px w-full bg-white"></span>
                    </span>
                </button>
            </div>

            <nav id="mobile-navigation" class="hidden border-t border-neutral-800 bg-black px-5 py-5 lg:hidden" aria-label="Mobile navigation" data-mobile-menu>
                <div class="grid gap-px bg-neutral-800">
                    @foreach ($navigationEvents as $navEvent)
                        <a href="{{ site_url($navEvent['slug']) }}" class="flex items-center justify-between bg-black px-4 py-4 text-xs font-bold uppercase tracking-[0.16em] transition hover:bg-neutral-900">
                            {{ $navEvent['name'] }}
                            <span aria-hidden="true">↗</span>
                        </a>
                    @endforeach
                </div>
            </nav>
        </header>

        <main id="main-content">
            @yield('content')
        </main>

        <footer class="border-t border-neutral-800 bg-neutral-950">
            <div class="mx-auto max-w-[96rem] px-5 py-14 sm:px-8 lg:px-12 lg:py-18">
                <div class="grid gap-12 lg:grid-cols-[1.2fr_2fr]">
                    <div>
                        <a href="{{ site_url() }}" class="text-2xl font-black uppercase tracking-[-0.05em]">Track Meats.</a>
                        <p class="mt-4 max-w-sm text-sm leading-6 text-neutral-500">Independent track events built around competition, community, and the culture of racing.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-8 sm:grid-cols-3">
                        <div>
                            <p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-neutral-600">Events</p>
                            <ul class="mt-4 space-y-3 text-sm font-semibold">
                                @foreach ($navigationEvents as $navEvent)
                                    <li><a class="transition hover:text-neutral-400" href="{{ site_url($navEvent['slug']) }}">{{ $navEvent['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-neutral-600">Navigate</p>
                            <ul class="mt-4 space-y-3 text-sm font-semibold">
                                <li><a class="transition hover:text-neutral-400" href="{{ site_url() }}">Home</a></li>
                                <li><a class="transition hover:text-neutral-400" href="{{ site_url() }}#events">Event series</a></li>
                            </ul>
                        </div>
                        <div>
                            <p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-neutral-600">Follow</p>
                            <ul class="mt-4 space-y-3 text-sm font-semibold text-neutral-400">
                                <li>Instagram — soon</li>
                                <li>YouTube — soon</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mt-14 flex flex-col gap-3 border-t border-neutral-800 pt-6 text-[0.65rem] font-semibold uppercase tracking-[0.15em] text-neutral-600 sm:flex-row sm:items-center sm:justify-between">
                    <p>&copy; {{ date('Y') }} Track Meats</p>
                    <p>Built for the next race</p>
                </div>
            </div>
        </footer>

        <script>
            const menuButton = document.querySelector('[data-menu-button]');
            const mobileMenu = document.querySelector('[data-mobile-menu]');

            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', () => {
                    const isOpen = menuButton.getAttribute('aria-expanded') === 'true';
                    menuButton.setAttribute('aria-expanded', String(!isOpen));
                    mobileMenu.classList.toggle('hidden');
                    menuButton.querySelector('.sr-only').textContent = isOpen ? 'Open navigation' : 'Close navigation';
                });
            }
        </script>
    </body>
</html>
