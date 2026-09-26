// Local-only preview of the same repository prefix used by GitHub Pages.
import { createServer } from 'node:http';
import { readFile, stat } from 'node:fs/promises';
import { resolve, extname, sep } from 'node:path';

const root = resolve('dist');
const prefix = '/' + (process.argv[2] || '').replace(/^\/+|\/+$/g, '');
const types = { '.html':'text/html; charset=utf-8', '.css':'text/css', '.js':'text/javascript', '.jpg':'image/jpeg', '.svg':'image/svg+xml', '.ico':'image/x-icon', '.txt':'text/plain; charset=utf-8', '.json':'application/json' };
createServer(async (request, response) => {
    try {
        const pathname = decodeURIComponent(new URL(request.url, 'http://127.0.0.1').pathname);
        if (prefix !== '/' && !pathname.startsWith(prefix + '/')) { response.writeHead(404); response.end('Not found'); return; }
        let path = resolve(root, '.' + (prefix === '/' ? pathname : pathname.slice(prefix.length)));
        if (path !== root && !path.startsWith(root + sep)) { response.writeHead(403); response.end('Forbidden'); return; }
        if ((await stat(path)).isDirectory()) path = resolve(path, 'index.html');
        const body = await readFile(path);
        response.writeHead(200, { 'Content-Type': types[extname(path)] || 'application/octet-stream', 'Cache-Control':'no-store' });
        response.end(body);
    } catch { response.writeHead(404); response.end('Not found'); }
}).listen(8001, '127.0.0.1', () => console.log(`Static preview: http://127.0.0.1:8001${prefix === '/' ? '' : prefix}/`));
