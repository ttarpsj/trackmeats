@props(['socials'])
<div class="social-links" aria-label="Social channels">
@foreach ($socials as $name => $url)
    <a href="{{ $url ?? '#social-status' }}" aria-label="{{ $name }}{{ $url ? '' : ' — channel coming soon' }}" title="{{ $name }}{{ $url ? '' : ' — coming soon' }}">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
            @switch($name)
                @case('Instagram')<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>@break
                @case('X')<path d="M4 3h4l12 18h-4L4 3Zm16 0L4 21"/>@break
                @case('YouTube')<rect x="2" y="5" width="20" height="14" rx="4"/><path d="m10 9 6 3-6 3z" fill="currentColor" stroke="none"/>@break
                @case('Spotify')<circle cx="12" cy="12" r="10"/><path d="M6 9c4-2 8-1 12 1M7 12c4-1 7-1 10 1M8 15c3-1 5-1 8 1" stroke-linecap="round"/>@break
            @endswitch
        </svg>
    </a>
@endforeach
</div>
