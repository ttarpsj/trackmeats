# Track Meats

A static Laravel showcase for four track events: Balboa Classic, Icahn Memorial, M10KE, and La Jolla Games. Laravel provides routing and reusable Blade templates locally; the deployed GitHub Pages artifact contains only static HTML and public assets.

## Local development with Herd

1. Clone the repository into your Herd directory and open `http://trackmeats.test`.
2. Run `composer install` and `npm install` after a fresh clone.
3. Copy `.env.example` to `.env` and run `php artisan key:generate` if Herd has not already prepared the app.
4. Run `npm run dev` while changing frontend assets. The current site layout loads Tailwind's browser CDN directly, so Blade-only changes also appear immediately.

No database, migrations, queue worker, accounts, or backend forms are required.

## Editing the site

- Event content, schedule rows, action URLs, and past results: `config/events.php`
- Master header, navigation, and footer: `resources/views/layouts/app.blade.php`
- Homepage: `resources/views/welcome.blade.php`
- Shared event page: `resources/views/events/show.blade.php`
- Event card: `resources/views/components/event-card.blade.php`
- Placeholder artwork: `public/images/events/{event-slug}/hero.svg`

Replace each `hero.svg` with your own licensed image and update `hero_image` in `config/events.php`. The views use responsive `object-cover` image treatment, and homepage images load lazily.

Action buttons only appear when their matching URL is present in `config/events.php`. Add live URLs to `registration_url`, `tickets_url`, `watch_url`, and `results_url` when they are available.

## Build and static export

```text
npm run build
composer run export
```

The export command renders `/`, `/balboa-classic`, `/icahn-memorial`, `/m10ke`, and `/la-jolla-games` into `dist/`, using an `index.html` in each route directory. It also copies public images/build assets and rejects pages that contain localhost or `.test` URLs.

To preview the GitHub project-path version locally:

```text
php artisan site:export --base-path=trackmeats
```

Leave the base path empty for a root custom domain. The `SITE_BASE_PATH` setting in `.env` offers the same control without a command option.

## GitHub Pages deployment

1. Create an empty GitHub repository named `trackmeats`.
2. Initialize Git in this directory, commit the project, add the GitHub remote, and push the `main` branch.
3. In the repository, open **Settings → Pages** and choose **GitHub Actions** as the source.
4. Push to `main`, or manually run the **Deploy static site to Pages** workflow.

The workflow installs PHP and Node dependencies, runs the frontend production build, exports the five routes with the repository-name base path, uploads only `dist/`, and deploys it with the official GitHub Pages actions. Future pushes to `main` redeploy automatically.

If you later attach a custom domain rooted at `/`, change the export step in `.github/workflows/pages.yml` to omit `--base-path`.

## Checks

Run the application tests with `composer test`. Before publishing, also run `npm run build` and `composer run export`.
