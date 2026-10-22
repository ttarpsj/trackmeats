<?php

// Single-event content. Dates, venue, entries and results are illustrative.
// Asset paths are relative to public/. Optional URLs stay null until configured.
$galleryTiles = array_fill(0, 12, ['media' => []]);
$galleryImages = array_filter(glob(public_path('images/gallery/*')) ?: [], static fn (string $path): bool =>
    is_file($path) && in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif'], true)
);
sort($galleryImages, SORT_NATURAL | SORT_FLAG_CASE);

foreach ($galleryImages as $index => $path) {
    $galleryTiles[$index % count($galleryTiles)]['media'][] = [
        'path' => 'images/gallery/'.basename($path),
        'alt' => 'Track Meats gallery image '.($index + 1),
    ];
}

return [
    'brand' => 'Track Meats',
    'name' => 'Track Meats',
    'name_lines' => ['Track', 'Meats'],
    'date' => 'Fridays From June - August',
    'location' => 'United States of America',
    'venue' => 'United States of America',
    'venue_note' => 'An imagined outdoor arena. No real venue affiliation.',
    'tagline' => 'Battle for the belt.',
    'description' => 'An independent celebration of fast racing, close competition and trackside culture. One oval. Every kind of runner.',
    'intro_heading' => ['One track. Every level. One night built around racing.'],
    'intro_lead' => 'Track Meats is a national summer series where community runners and professional athletes race on the same track, on the same night, in front of the same crowd.',
    'intro' => [
        'The program starts with open races for local athletes, clubs and anyone ready to test their fitness. As the night builds, invitational fields take over with elite athletes racing for serious prize money, fast times and the win.',
        'It is competition without separating the community from the spectacle.',
        'Run your mile. Chase a personal best. Race with your club. Then step trackside and watch some of the fastest athletes in the country do the same thing at another level.',
        'Local clubs, vendors, food, music and spectators surround the track, turning a traditional meet into a summer night built around athletics.'
    ],
    'intro_closing' => 'Come to race. Stay for the racing.',
    'demo_notice' => 'A fictional event, made to show what a race can become. Dates, venue, athletes and results are illustrative.',
    'hero_image' => 'images/balboa/race-at-dusk.jpg',
    'hero_alt' => 'AI-generated editorial scene of distance runners racing on an outdoor track at dusk.',
    'support_image' => 'images/balboa/in-stride.jpg',
    'support_alt' => 'AI-generated close-up of runners in stride on a sunlit athletics track.',
    'registration_url' => 'https://ellipsisetc.xyz/pages/contact',
    'tickets_url' => null,
    'watch_url' => null,
    'results_url' => null,
    'newsletter_url' => 'https://ellipsisetc.xyz/pages/contact',
    'contact_email' => null,
    'organizer' => 'Track Meats — independent athletics, imagined.',
    'socials' => ['Instagram' => 'https://www.instagram.com/officaltrackmeats/', 'X' => 'https://x.com/', 'YouTube' => 'https://www.youtube.com/', 'Spotify' => 'https://open.spotify.com/track/3jDdpx9PMlfMBS5tOBHFm9'],
    'navigation' => ['about' => 'The meats', 'schedule' => 'Schedule', 'information' => 'Event info', 'results' => 'Archive', 'gallery' => 'Gallery'],
    'schedule_note' => 'Illustrative local times. Each timetable is a separate session of the same meet; final race orders are not confirmed.',
    'opening_events_session' => 'Opening events, 3 heats for each gender*',
    'opening_events' => [
        ['time' => '4:00 PM', 'event' => 'Community Mile', 'division' => 'Open', 'heat' => 'Heat 1', 'note' => 'Maximum 20 athletes'],
        ['time' => '4:08 PM', 'event' => 'Community Mile', 'division' => 'Open', 'heat' => 'Heat 2', 'note' => 'Maximum 20 athletes'],
        ['time' => '4:16 PM', 'event' => 'Community Mile', 'division' => 'Open', 'heat' => 'Heat 3', 'note' => 'Reserved for the top 18 fastest registrations'],
        ['time' => '4:30 PM', 'event' => '5000m', 'division' => 'Open', 'heat' => 'Heat 1', 'note' => 'Maximum 30 runners'],
        ['time' => '4:55 PM', 'event' => '5000m', 'division' => 'Open', 'heat' => 'Heat 2', 'note' => 'Maximum 30 runners'],
        ['time' => '5:20 PM', 'event' => '5000m', 'division' => 'Open', 'heat' => 'Heat 3', 'note' => 'Reserved for the top 22 fastest registrations'],
        ['time' => '5:50 PM', 'event' => '800m', 'division' => 'Open', 'heat' => 'Heat 1', 'note' => 'Maximum 10 runners'],
        ['time' => '5:58 PM', 'event' => '800m', 'division' => 'Open', 'heat' => 'Heat 2', 'note' => 'Reserved for the top 8 fastest registrations'],
        ['time' => '6:08 PM', 'event' => '4x400m Mixed Relay', 'division' => 'Clubs', 'heat' => 'Heat 1', 'note' => 'Clubs are selected by the top submissions'],
    ],
    'sessions' => ['amateur' => 'Friday 4 June · Open session', 'elite' => 'Saturday 5 June · Evening session'],
    'schedule' => [
        'amateur' => [
            ['time' => '4:00 PM', 'event' => '5000m', 'division' => 'Open', 'heat' => 'Heat 1'],
            ['time' => '4:20 PM', 'event' => '5000m', 'division' => 'Open', 'heat' => 'Heat 2'],
            ['time' => '4:30 PM', 'event' => 'Community Mile', 'division' => 'Open', 'note' => 'All abilities'],
            ['time' => '4:40 PM', 'event' => '5000m', 'division' => 'Prize money', 'heat' => 'Heat 3', 'note' => 'Amateur-Elite · illustrative award category'],
            ['time' => '5:00 PM', 'event' => '4x400m Relay', 'division' => 'Clubs'],
            ['time' => '5:15 PM', 'event' => 'Mile', 'division' => 'Open', 'heat' => 'Heat 1'],
            ['time' => '5:22 PM', 'event' => 'Mile', 'division' => 'Open', 'heat' => 'Heat 2'],
            ['time' => '5:29 PM', 'event' => 'Mile', 'division' => 'Prize money', 'heat' => 'Heat 3', 'note' => 'Amateur-Elite · illustrative award category'],
        ],
        'elite' => [
            ['time' => '5:30 PM', 'event' => 'Community Mile', 'division' => 'Open', 'heat' => 'All abilities'],
            ['time' => '6:15 PM', 'event' => '800m', 'division' => 'Women / Men', 'heat' => 'Invitational'],
            ['time' => '7:10 PM', 'event' => '1500m', 'division' => 'Women / Men', 'heat' => 'Invitational'],
            ['time' => '8:00 PM', 'event' => '5000m', 'division' => 'Championship', 'heat' => 'Final'],
        ],
    ],
    'meet_locations' => [
        'chicago' => ['label' => 'Chicago · 6/4', 'sessions' => ['amateur' => 'Friday · Open session', 'elite' => 'Saturday · Evening session'], 'schedule' => ['amateur' => [['time' => '4:00 PM', 'event' => 'Community Mile', 'division' => 'Open', 'heat' => 'All abilities'], ['time' => '4:30 PM', 'event' => '5000m', 'division' => 'Open', 'heat' => 'Heat 1'], ['time' => '5:10 PM', 'event' => '4x400m Relay', 'division' => 'Clubs']], 'elite' => [['time' => '6:15 PM', 'event' => '800m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:00 PM', 'event' => '1500m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:50 PM', 'event' => '5000m', 'division' => 'Championship', 'heat' => 'Final']]]],
        'san-diego' => ['label' => 'San Diego · 6/11', 'sessions' => ['amateur' => 'Friday · Open session', 'elite' => 'Saturday · Evening session'], 'schedule' => ['amateur' => [['time' => '4:00 PM', 'event' => '5000m', 'division' => 'Open', 'heat' => 'Heat 1'], ['time' => '4:30 PM', 'event' => 'Community Mile', 'division' => 'Open', 'note' => 'All abilities'], ['time' => '5:00 PM', 'event' => 'Mile', 'division' => 'Prize money', 'heat' => 'Heat 3']], 'elite' => [['time' => '6:15 PM', 'event' => '800m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:10 PM', 'event' => '1500m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '8:00 PM', 'event' => '5000m', 'division' => 'Championship', 'heat' => 'Final']]]],
        'seattle' => ['label' => 'Seattle · 6/18', 'sessions' => ['amateur' => 'Friday · Open session', 'elite' => 'Saturday · Night session'], 'schedule' => ['amateur' => [['time' => '4:15 PM', 'event' => '3000m', 'division' => 'Open', 'heat' => 'Heat 1'], ['time' => '4:50 PM', 'event' => '800m', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '5:25 PM', 'event' => '4x800m Relay', 'division' => 'Clubs']], 'elite' => [['time' => '6:10 PM', 'event' => '3000m Steeplechase', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:00 PM', 'event' => 'Mile', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:45 PM', 'event' => '10,000m', 'division' => 'Championship', 'heat' => 'Final']]]],
        'new-york' => ['label' => 'New York · 6/25', 'sessions' => ['amateur' => 'Friday · Open session', 'elite' => 'Saturday · Evening session'], 'schedule' => ['amateur' => [['time' => '4:00 PM', 'event' => '400m', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '4:35 PM', 'event' => '1500m', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '5:15 PM', 'event' => 'Sprint Medley Relay', 'division' => 'Clubs']], 'elite' => [['time' => '6:00 PM', 'event' => '400m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '6:45 PM', 'event' => 'Mile', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:35 PM', 'event' => '3000m', 'division' => 'Championship', 'heat' => 'Final']]]],
        'miami' => ['label' => 'Miami · 7/2', 'sessions' => ['amateur' => 'Friday · Open session', 'elite' => 'Saturday · Night session'], 'schedule' => ['amateur' => [['time' => '5:00 PM', 'event' => '200m', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '5:35 PM', 'event' => '400m', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '6:10 PM', 'event' => '4x100m Relay', 'division' => 'Clubs']], 'elite' => [['time' => '7:00 PM', 'event' => '100m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:35 PM', 'event' => '400m Hurdles', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '8:10 PM', 'event' => '4x400m Relay', 'division' => 'Championship', 'heat' => 'Final']]]],
        'milwaukee' => ['label' => 'Milwaukee · 7/9', 'sessions' => ['amateur' => 'Friday · Open session', 'elite' => 'Saturday · Evening session'], 'schedule' => ['amateur' => [['time' => '4:10 PM', 'event' => 'Mile', 'division' => 'Open', 'heat' => 'Heat 1'], ['time' => '4:45 PM', 'event' => '5000m', 'division' => 'Open', 'heat' => 'Heat 2'], ['time' => '5:30 PM', 'event' => 'Distance Medley Relay', 'division' => 'Clubs']], 'elite' => [['time' => '6:15 PM', 'event' => '1500m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:05 PM', 'event' => '5000m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '8:00 PM', 'event' => '10,000m', 'division' => 'Championship', 'heat' => 'Final']]]],
        'austin' => ['label' => 'Austin · 7/16', 'sessions' => ['amateur' => 'Friday · Open session', 'elite' => 'Saturday · Evening session'], 'schedule' => ['amateur' => [['time' => '5:00 PM', 'event' => '800m', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '5:35 PM', 'event' => '1500m', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '6:10 PM', 'event' => '4x400m Relay', 'division' => 'Clubs']], 'elite' => [['time' => '7:00 PM', 'event' => '800m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:40 PM', 'event' => '1500m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '8:20 PM', 'event' => 'Mile', 'division' => 'Championship', 'heat' => 'Final']]]],
        'new-orleans' => ['label' => 'New Orleans · 7/23', 'sessions' => ['amateur' => 'Friday · Open session', 'elite' => 'Saturday · Night session'], 'schedule' => ['amateur' => [['time' => '5:00 PM', 'event' => '400m Hurdles', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '5:40 PM', 'event' => '800m', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '6:15 PM', 'event' => '4x100m Relay', 'division' => 'Clubs']], 'elite' => [['time' => '7:00 PM', 'event' => '400m Hurdles', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:45 PM', 'event' => '800m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '8:25 PM', 'event' => '4x400m Relay', 'division' => 'Championship', 'heat' => 'Final']]]],
        'los-angeles' => ['label' => 'Los Angeles · 7/30', 'sessions' => ['amateur' => 'Friday · Open session', 'elite' => 'Saturday · Evening session'], 'schedule' => ['amateur' => [['time' => '4:30 PM', 'event' => '100m', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '5:00 PM', 'event' => '200m', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '5:35 PM', 'event' => '4x100m Relay', 'division' => 'Clubs']], 'elite' => [['time' => '6:30 PM', 'event' => '100m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:10 PM', 'event' => '200m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:50 PM', 'event' => '400m', 'division' => 'Championship', 'heat' => 'Final']]]],
        'boston' => ['label' => 'Boston · 8/6', 'sessions' => ['amateur' => 'Friday · Open session', 'elite' => 'Saturday · Evening session'], 'schedule' => ['amateur' => [['time' => '4:15 PM', 'event' => '3000m', 'division' => 'Open', 'heat' => 'Heat 1'], ['time' => '4:55 PM', 'event' => 'Mile', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '5:35 PM', 'event' => '4x800m Relay', 'division' => 'Clubs']], 'elite' => [['time' => '6:15 PM', 'event' => '3000m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:00 PM', 'event' => 'Mile', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:45 PM', 'event' => '5000m', 'division' => 'Championship', 'heat' => 'Final']]]],
        'portland' => ['label' => 'Portland · 8/13', 'sessions' => ['amateur' => 'Friday · Open session', 'elite' => 'Saturday · Evening session'], 'schedule' => ['amateur' => [['time' => '4:00 PM', 'event' => '5000m', 'division' => 'Open', 'heat' => 'Heat 1'], ['time' => '4:45 PM', 'event' => '10,000m', 'division' => 'Open', 'heat' => 'Final'], ['time' => '5:40 PM', 'event' => '4x1500m Relay', 'division' => 'Clubs']], 'elite' => [['time' => '6:20 PM', 'event' => '5000m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:15 PM', 'event' => '10,000m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '8:15 PM', 'event' => 'Mile', 'division' => 'Championship', 'heat' => 'Final']]]],
        'atlanta' => ['label' => 'Atlanta · 8/20', 'sessions' => ['amateur' => 'Friday · Open session', 'elite' => 'Saturday · Evening session'], 'schedule' => ['amateur' => [['time' => '5:00 PM', 'event' => '400m', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '5:40 PM', 'event' => '800m', 'division' => 'Open', 'heat' => 'Heats'], ['time' => '6:15 PM', 'event' => '4x400m Relay', 'division' => 'Clubs']], 'elite' => [['time' => '7:00 PM', 'event' => '400m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '7:40 PM', 'event' => '800m', 'division' => 'Women / Men', 'heat' => 'Invitational'], ['time' => '8:20 PM', 'event' => '4x400m Relay', 'division' => 'Championship', 'heat' => 'Final']]]],
    ],
    'information' => [
        'details' => ['label' => 'Event Details', 'eyebrow' => 'An invitation to the oval', 'title' => 'Race it. Watch it. Feel it.', 'paragraphs' => ['Track Meats brings community racing and elite competition into one continuous night on the track.', 'The early program is built for local runners, clubs and athletes looking to test their fitness in properly organized races with real pacing, timing and competitive fields. As the evening progresses, the fastest heats and invitational races take over, bringing professional and emerging athletes onto the same oval for high-level racing and prize money.', 'There is no separation between participant and spectator. Race your event, stay trackside, and watch the night build.'], 'facts' => ['Format' => 'Outdoor track · Open & invitational', 'Entry status' => 'Open registration for amateur events on a first-come, first-served basis. Selected faster amateur heats require a verified qualifying time.', 'Tickets' => 'No ticket required. Open venue admission, or watch the event recap on our YouTube channel.']],
        'awards' => ['label' => 'Awards / Prizes', 'eyebrow' => 'Something worth chasing', 'title' => 'Prize Money', 'paragraphs' => ['The fastest amateur heats and elite invitational races carry prize money, giving every level of the meet something meaningful to race for.', 'Top amateur heats for each gender award: 1st — $200; 2nd — $150; 3rd — $50.', 'Elite invitational races for each gender award: 1st — $750; 2nd — $600; 3rd — $450; 4th — $350; 5th — $250.', 'Podium presentations follow the featured races, with awards presented trackside at each venue.'], 'facts' => ['Amateur purse' => '$400 per qualifying top heat, per gender', 'Elite purse' => '$2,400 per invitational race, per gender']],
        'venue' => ['label' => 'Venue', 'eyebrow' => 'Close to the action', 'title' => 'An oval with atmosphere.', 'paragraphs' => ['Track Meats is a hypothetical event structure designed to showcase a variety of events and display the opportunity.', 'Parking, transit, accessible viewing, step-free access and stadium policies would be confirmed with a real venue ahead of race week. Please do not use this demo for travel planning.']],
        'rules' => ['label' => 'Competition Rules', 'eyebrow' => 'On equal terms', 'title' => 'Good racing starts here.', 'paragraphs' => ['This sample competition guide is not an approved or sanctioned rulebook.'], 'items' => ['Fields would be seeded by verified recent performances.', 'Athletes would report to the call area before their assigned race.', 'Equipment checks, protest procedures and timing protocols would appear in the final technical guide.', 'No governing-body approval or competition classification is claimed.']],
        'stay' => ['label' => 'Run, Stay, Eat — Accommodation Discounts', 'eyebrow' => 'Outside the oval', 'title' => 'Beyond the finish line.', 'paragraphs' => ['A future visitor guide would bring together places to stay, post-race food and easy routes to the track.', 'No hotel partnerships or accommodation discounts are currently offered. Rates, booking links and terms would appear here only after an agreement is confirmed.'], 'facts' => ['Stay' => 'Accommodation guide coming soon', 'Eat' => 'Local recommendations to follow', 'Travel' => 'Transport details to be confirmed']],
        'handbook' => ['label' => 'Contestant Handbook', 'eyebrow' => 'Ready to race', 'title' => 'Your weekend, in order.', 'paragraphs' => ['A sample athlete checklist. Final reporting times, credential collection and warm-up access are not yet available.'], 'items' => ['Before arrival: check your entry and race assignment.', 'At the venue: collect credentials and locate the warm-up area.', 'Before the start: report to athlete check-in as directed.', 'After the race: leave the track safely and follow recovery-area guidance.']],
        'guide' => ['label' => 'Race Guide', 'eyebrow' => 'Every lap matters', 'title' => 'Find your race.', 'paragraphs' => ['Open racing welcomes a broad range of abilities. The invitational session brings compact fields, purposeful pacing and a final race under the lights.', 'Explore the Amateur and Elite timetables for the illustrative running order. Heat allocations would follow confirmed entries.'], 'link' => ['label' => 'Explore the schedule', 'href' => '#schedule']],
        'achievements' => ['label' => 'Past Achievements and Certificates', 'eyebrow' => 'Keep the memory', 'title' => 'A record of the effort.', 'paragraphs' => ['The archive shows sample past editions. All times and athlete names are fictional and must not be used as qualification evidence.', 'Finisher certificates could be linked here after a real competition. No certificates or official records are being issued by this demonstration site.'], 'link' => ['label' => 'View the demo archive', 'href' => '#results']],
        'terms' => ['label' => 'Terms and Conditions', 'eyebrow' => 'Before you take part', 'title' => 'A demonstration, clearly.', 'paragraphs' => ['This is a portfolio concept, not an offer to enter a competition or purchase a ticket. No payment, booking or personal-data submission is accepted here.', 'Actual participation terms, cancellation arrangements, eligibility requirements and privacy information must be supplied before launch. This placeholder is not a participant agreement.']],
        'disclaimer' => ['label' => 'Disclaimer', 'eyebrow' => 'The small print', 'title' => 'Imagined. Not announced.', 'paragraphs' => ['Track Meats is collection of fictional competitions (ad of now). Dates, venue, athletes, awards, schedules and results are illustrative; no real event or commercial relationship is represented.', 'Photography is AI-generated and does not depict actual entrants. No sponsor, federation, athlete or venue endorsement is implied. This independently branded design is not affiliated with any governing body.']],
        'faqs' => ['label' => 'FAQs', 'eyebrow' => 'A few good questions', 'title' => 'Before the starting gun.', 'faqs' => [['question' => 'Can I register or buy a ticket?', 'answer' => 'Not yet. This is a portfolio demonstration. Registration and ticket buttons explain the current status rather than taking payment.'], ['question' => 'Is this a confirmed venue or date?', 'answer' => 'No. The location, venue and dates are illustrative. Please do not make travel arrangements based on this site.'], ['question' => 'Are Amateur and Elite separate events?', 'answer' => 'They are two sessions of the same meeting. Switch the schedule to explore both.'], ['question' => 'Where is the accessibility information?', 'answer' => 'Access details would be confirmed before real entries open. The Venue panel contains the current placeholder guidance.']]],
    ],
    'past_results' => [
        ['year' => '2026', 'summary' => '13 events held', 'rows' => [['race' => '1500m', 'athlete' => 'Alex Mercer', 'time' => '3:42.18'], ['race' => '800m', 'athlete' => 'Jordan Vale', 'time' => '2:01.64']]],
        ['year' => '2025', 'summary' => '11 Events held', 'rows' => [['race' => '5000m', 'athlete' => 'Sam Rowan', 'time' => '14:08.32']]],
        ['year' => '2024', 'summary' => '12 events held', 'rows' => [['race' => 'Mile', 'athlete' => 'Casey Linden', 'time' => '4:09.76']]],
        ['year' => '2023', 'summary' => '9 Events held', 'rows' => [['race' => '800m', 'athlete' => 'Riley North', 'time' => '1:51.20']]],
    ],
    'archive_gallery' => [
        'title' => 'Gallery',
        'placeholder_colors' => ['#b34a28', '#111210', '#777970', '#d5d4cd', '#f5f4ef'],
        'tiles' => $galleryTiles,
    ],
    'media' => [
        ['title' => 'Press accreditation', 'body' => 'A considered place for the people who tell the story. A future accreditation form would collect publication details, assignment information and access requirements. Applications are not open in this demo.'],
        ['title' => 'Photography & filming', 'body' => 'A real media guide would define shooting positions, track access and interview areas. The imagery here is AI-generated concept material, not documentary event coverage.'],
        ['title' => 'Press materials', 'body' => 'Download a clearly labeled concept press note. Official logos, confirmed facts and licensed photography would be supplied before a real launch.', 'download' => true],
        ['title' => 'Media & organizer inquiries', 'body' => 'The media desk would coordinate interviews, features and event-day requests. No active contact address is configured for this fictional event.'],
    ],
];
