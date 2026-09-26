# Track Meats / Balboa Classic

One fictional athletics event, built as an editorial portfolio showcase. Laravel 12 and Blade render the site; Vite and Tailwind build the CSS and small vanilla-JavaScript interactions. GitHub Pages serves the static export. No database, accounts, payment flow or form backend.

## Run locally

1. Install dependencies with `composer install` and `npm ci`.
2. Copy `.env.example` to `.env` and run `php artisan key:generate` if needed.
3. Run `npm run build` and `php artisan serve`, or use Herd and `npm run dev` while editing.
4. Open the local URL reported by Laravel or Herd.

The site now uses compiled CSS/JS, not the Tailwind browser CDN.

## Edit the event

All event-specific data lives in **config/events.php**. Despite the existing filename, this is a single flat event definition, not an event directory.

| Content | Configuration keys |
| --- | --- |
| Identity and hero | brand, name, name_lines, tagline, description |
| Dates and setting | date, location, venue, venue_note, sessions |
| Photography | hero_image, hero_alt, support_image, support_alt |
| Intro | intro_heading, intro, demo_notice |
| Timetables | schedule.amateur, schedule.elite, schedule_note |
| All 12 information panels | information (paragraphs, facts, entries, lists, FAQs) |
| Athletes, awards, travel, rules | information.runners / awards / stay / rules |
| Results | past_results |
| Media and organizer | media, organizer, contact_email |
| Real integrations | registration_url, tickets_url, watch_url, results_url, newsletter_url, socials |

Keep the title lines, date/session labels and related prose consistent when editing. Asset paths are relative to public/. Replace the local JPEGs with licensed imagery and update alt text. All provided dates, venue, entrants and results are clearly marked as illustrative.

Null registration/ticket URLs lead to an honest status section. Null social URLs lead to the channel-status notice. No newsletter form is shown until a real signup URL is configured; the configured link opens the external provider's page without pretending to submit anything locally.

## Presentation files

- resources/views/layouts/app.blade.php — document, header, mobile menu, footer.
- resources/views/welcome.blade.php — homepage wrapper.
- resources/views/events/show.blade.php — single-event page body.
- resources/views/components/social-links.blade.php — social icons and links.
- resources/views/events/press-note.blade.php — downloadable text, generated from the same event data.
- resources/css/app.css — responsive visual system and reduced-motion treatment.
- resources/js/app.js — menu, schedule/information tabs and legal deep links.
- public/images/balboa/ — optimized concept photography; prompts in docs/imagery.md.

Tabs support arrow keys, Home and End, with one focusable active tab. Elite is the default schedule. On mobile the information selector scrolls horizontally; all 12 categories remain available. Legal footer links open their matching panel. Results and media use native expandable details.

## Build and static export

```text
npm run build
php artisan test
php artisan site:export --base-path=trackmeats
node scripts/check-static.mjs trackmeats
node scripts/preview-static.mjs trackmeats
```

The export creates dist/index.html, compiled assets, local photographs, a generated downloads/press-note.txt, and .nojekyll. It rejects local development URLs and bypasses any running Vite development server.

The check script validates every internal asset, link target and controlled panel in the exported pages. The preview script serves the project-prefixed site at http://127.0.0.1:8001/trackmeats/ without Laravel. For a root-path export, omit the trackmeats argument from both scripts.

Former event URLs are preserved as compatibility redirects to the one homepage: /balboa-classic, /icahn-memorial, /m10ke and /la-jolla-games. Laravel returns 301 responses; GitHub Pages gets small static redirect pages with visible fallback links. There are no other event pages or event-switching navigation.

For a root domain, omit --base-path and leave SITE_BASE_PATH empty. The existing GitHub Actions workflow is unchanged: it builds assets, exports using the repository name as the URL prefix, and deploys dist. GitHub Settings → Pages must use GitHub Actions.

## Design and content provenance

The compositional reference is Sound Running's Invite page: photographic hero, restrained overlay navigation, spacious editorial intro, black schedule, archive, media accordions and substantial footer. No reference photographs, branding or copy were reused.

The project retains the Balboa Classic identity and existing schedule entries, sorts the amateur timetable chronologically, and replaces the actual stadium association with a fictional setting. Other competition content is no longer published. Existing unused placeholder artwork and the old card component remain untouched.

The downloadable press note is deliberately labeled concept material. No actual event, sanctioning, athlete commitment, venue partnership or sponsor endorsement is represented.
