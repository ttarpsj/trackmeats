# Redesign verification — 26 September 2026

## Executed checks

- Production Vite build passed. Final application CSS: 36.55 kB (8.63 kB gzip); JavaScript: 2.17 kB (0.91 kB gzip).
- Laravel tests: 11 passed, 90 assertions. Covers single-event content, 12 accessible information panels, legacy redirects, unknown routes, concept press download, export prefixes and optional integrations.
- PHP formatting check/fix and git diff whitespace check passed.
- Root-path and /trackmeats/ static exports passed. Each export contains one event homepage plus four compatibility redirect documents.
- Static checker verified 54 internal asset/link references and all aria-controls targets in each export.
- Browser inspected at 1440px and 1280px desktop, 768px tablet, 390px mobile and 320px narrow mobile. No document-level horizontal overflow detected.
- Elite is initially selected. Amateur renders 8 original schedule entries; Elite renders 4. Click and arrow-key switching verified.
- All 12 information selectors opened their matching content. Home/End navigation, mobile horizontal selection and legal deep links verified.
- Mobile menu opens/closes, closes on navigation, and closes with Escape while returning focus to its button.
- All four result archives and four media disclosures open. Image assets load. No browser console warnings/errors observed in the tested local and exported views.
- The project-prefixed static page was loaded in a separate server without Laravel. Schedule and legal-panel interactions work. The old Balboa URL redirects to the homepage.
- Concept press download response and exported text file verified.

## Scope and limitations

The Sound Running Invite reference was inspected visually at desktop and mobile sizes. Its composition informed the original design; its brand assets and copy were not reused.

GitHub Actions was inspected and left unchanged. The export was verified locally; no live deployment, push or GitHub-hosted workflow run was performed.

Real registration, tickets, newsletter, social channels and organizer contact details remain unconfigured. Their placeholders are intentionally honest; no external purchase, subscription or form submission was tested or simulated.

Google Fonts remains an external dependency with local font fallbacks. Browser checks used the available Chromium-based browser, not a complete cross-browser or assistive-technology audit.

## Modified and added areas

- config/events.php and config/site.php — single-event content and compatibility/export settings.
- resources/views/layouts/app.blade.php, welcome.blade.php and events/show.blade.php — the complete standalone page.
- resources/views/components/social-links.blade.php and events/press-note.blade.php — shared icons and generated press copy.
- resources/css/app.css and resources/js/app.js — responsive visual system and accessible controls.
- routes/web.php and routes/console.php — homepage, download, legacy redirects and static output.
- tests/Feature/ExampleTest.php — updated feature coverage.
- scripts/check-static.mjs and scripts/preview-static.mjs — reproducible export validation and preview.
- public/images/balboa/race-at-dusk.jpg and in-stride.jpg — original generated imagery.
- README.md, docs/imagery.md and this file — edit guide, image provenance and verification.

Existing unused card component and previous placeholder SVGs were retained. The former multi-event content was replaced to satisfy the one-event brief; old URLs remain compatible.
