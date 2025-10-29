Paperfox WP Static — Build and Deploy

Overview
- Frontend and WordPress theme source lives in `dev/`.
- Gulp builds artifacts into `dist/`:
  - `dist/paperfox` — WordPress theme (PHP, CSS, JS, static assets)
  - `dist/www` — static HTML pages
  - `dist/src` — page-level JS
- Deploy flows support local copy or remote FTP.

Prerequisites
- Node.js 18 LTS (see `.nvmrc`)
- npm 9+
- Optional: FTP credentials for remote deploys

Install
1. Copy `.env` from `local.env` or create your own.
2. Fill in required variables:
   - LOCAL_SERVER=<local path prefix> (e.g. `C:/xampp/htdocs/paperfox`)
   - REMOTE_SERVER=<remote base path> (e.g. `/public_html`)
   - PROD_SERVER=<prod base path or URL prefix>
   - FTP_HOST, FTP_USER, FTP_PASSWORD (if using remote/prod deploy)
   - IS_CONCAT_CSS=true|false (enable CSS concatenation into `style.css`)
3. Install dependencies:
   - `npm ci`

Common Commands
- Watch + deploy to local: `npm run watch_to_local`
- Watch + deploy to remote: `npm run watch_to_remote`
- One-shot deploy local: `npm run deploy_to_local`
- One-shot deploy remote: `npm run deploy_to_remote`

Build Details
- Pages: HTML includes + placeholder replacement + WebP transform → `dist/www`
- Theme: PHP includes + placeholder replacement + `src="./static` remapped to WP theme static → `dist/paperfox`
- Styles: if `IS_CONCAT_CSS=true` concatenates prioritized CSS into `style.css`; otherwise copies as-is
- Assets: copies originals and adds WebP variants to `dist/paperfox/static`
- Page JS: copies from `dev/src` to `dist/src`

Environment Profiles
- `const.js` contains placeholders for local/test/prod. Adjust to your actual domains and paths.

Notes
- `.env` is git-ignored. Provide your own per environment.
- `.DS_Store` and similar OS files should be ignored by Git.
- For production deploy, ensure the corresponding options are wired (target path or URL and FTP creds).

