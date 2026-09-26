import { readFileSync, existsSync, readdirSync, statSync } from 'node:fs';
import { resolve, join, relative } from 'node:path';

const root = resolve('dist');
const prefix = '/' + (process.argv[2] || '').replace(/^\/+|\/+$/g, '');
const pages = [];
const visit = (directory) => {
    for (const entry of readdirSync(directory, { withFileTypes: true })) {
        const path = join(directory, entry.name);
        if (entry.isDirectory()) visit(path);
        else if (entry.name.endsWith('.html')) pages.push(path);
    }
};
visit(root);
const failures = [];
let checked = 0;
for (const page of pages) {
    const html = readFileSync(page, 'utf8');
    if (/localhost|127\.0\.0\.1|\.test(?:[/:]|$)/i.test(html)) failures.push(`${page}: local URL`);
    const ids = new Set([...html.matchAll(/\bid="([^"]+)"/g)].map((match) => match[1]));
    for (const [, raw] of html.matchAll(/\b(?:href|src)="([^"]+)"/g)) {
        const url = raw.replaceAll('&amp;', '&');
        if (/^(https?:|mailto:|data:)/.test(url)) continue;
        checked++;
        if (url.startsWith('#')) {
            if (!ids.has(url.slice(1))) failures.push(`${page}: missing anchor ${url}`);
            continue;
        }
        if (prefix !== '/' && !url.startsWith(prefix + '/')) {
            failures.push(`${page}: missing project prefix ${url}`);
            continue;
        }
        const target = resolve(root, '.' + (prefix === '/' ? url : url.slice(prefix.length)).split(/[?#]/)[0]);
        if (!target.startsWith(root) || !existsSync(target)) failures.push(`${page}: missing asset ${url}`);
        else if (statSync(target).isDirectory() && !existsSync(join(target, 'index.html'))) failures.push(`${page}: missing index ${url}`);
    }
    for (const [, panel] of html.matchAll(/aria-controls="([^"]+)"/g)) {
        if (!ids.has(panel)) failures.push(`${page}: missing controlled panel ${panel}`);
    }
    console.log(`Checked ${relative(root, page)}`);
}
if (failures.length) { console.error(failures.join('\n')); process.exitCode = 1; }
else console.log(`PASS: ${pages.length} pages, ${checked} internal links/assets and all controlled panels resolve.`);
