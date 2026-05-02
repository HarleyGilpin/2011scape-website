# 2011scape Static Site → Laravel 11

## Context

`/home/user/2011scape-website/` currently holds a static backup of the 2011 RuneScape website (HTML/CSS/IMG/JS only — no Laravel scaffolding yet). The goal is to convert it into a working Laravel 11 site that pairs with an existing 2011scape private-server emulator (Postgres-backed). Forums are handled by Xenforo and out of scope. The result should preserve the original URLs and 2011 look-and-feel while wiring up auth, news, knowledge base, hiscores, item DB, and adventurer's log against the live game DB.

User decisions captured:
- **Stack:** Laravel 11, **Blade only** (no Livewire/Inertia).
- **DB:** App DB (MySQL/SQLite for news/KB/devblog/tickets) + read-only Postgres connection to game server (`pgsql_game`).
- **Auth:** Custom user provider against game `accounts` table; **Xenforo SSO bridge** so a Laravel login also logs into the forum.
- **URLs preserved verbatim** — e.g. `/services/m=news/newsitem-id-{id}.html`, `/kbase/guid/{slug}.html`, `/secure/m=weblogin/loginform.html`.
- **Game launch pages** (`/world8/`, `/world14/`, `/classicapplet/`, `game.html`) replaced with a modern launcher download page pointing to `/downloads/`.
- **Billing pages** kept as informational "all benefits free on this server" — chrome preserved, payment forms replaced with notice.
- **KB** (1,231 articles) migrated into a `kb_articles` table via artisan import.
- **Forums** (`/services/m=forum*`) redirect to `XENFORO_URL`.

Working branch: `claude/runescape-laravel-conversion-Qw82O` (already checked out).

---

## Plan

### 1. Scaffold Laravel into the existing repo

The repo has no `composer.json`/`artisan`. Stash the static tree, install Laravel, then redistribute.

1. `git mv` everything except `.git`, `.gitignore`, `README*` into `_legacy/`. Commit.
2. `composer create-project laravel/laravel . "11.*"` at repo root.
3. Move asset directories straight into `public/` so original URLs continue to resolve unchanged:
   - `_legacy/css` → `public/css`
   - `_legacy/img` → `public/img`
   - `_legacy/static` → `public/static`
   - `_legacy/wb-static` → `public/wb-static`
   - `_legacy/jagex.com` → `public/jagex.com`
   - `_legacy/downloads` → `public/downloads`
4. Add `symfony/dom-crawler` for HTML parsing during migration.
5. Keep `_legacy/` until parity verified, then `git rm -r _legacy/`.

### 2. Two-DB configuration

`.env`:
```
DB_CONNECTION=mysql                    # app DB
GAME_DB_HOST=...
GAME_DB_DATABASE=2011scape
GAME_DB_USERNAME=...
GAME_DB_PASSWORD=...
XENFORO_URL=https://forum.example.com
XENFORO_DB_*=...                       # if direct-DB SSO
GAME_PASSWORD_ALGO=bcrypt              # confirm — see Assumptions
```

`config/database.php` — add `pgsql_game` connection; force read-only via service provider hook (`SET default_transaction_read_only=on` on connect).

### 3. Routing — preserve original URLs

`routes/web.php` (split into `routes/modules/{auth,billing,news,kb,services,legal,gamelaunch}.php` for sanity). Laravel handles literal `=`, `,`, `.html` in segments fine. Examples:

```php
Route::get('/',                                                 [HomeController::class,'index']);
Route::get('/services/m=news/{slug}.html',                      [NewsController::class,'show']);
Route::get('/services/m=news/latest_news.rss',                  [NewsController::class,'rss']);
Route::get('/services/m=devblog/{slug}.html',                   [DevblogController::class,'show']);
Route::get('/kbase/guid/{slug}.html',                           [KbaseController::class,'show']);
Route::get('/kbase/search.html',                                [KbaseController::class,'search']);
Route::match(['get','post'],'/secure/m=weblogin/loginform.html',[AuthController::class,'form']);
Route::post('/secure/m=weblogin/login.ws',                      [AuthController::class,'login']);
Route::get('/secure/m=billing_core/{page}.html',                [BillingController::class,'show']);
Route::get('/secure/m=displaynames/name.html',                  [DisplaynameController::class,'form']);
Route::get('/secure/m=ticketing/{page}.html',                   [TicketingController::class,'show']);
Route::get('/services/m=adventurers-log/a={user}/main.ws',      [AdventurersLogController::class,'show']);
Route::get('/services/m=hiscore/ranking.ws',                    [HiscoresController::class,'ranking']);
Route::get('/services/m=itemdb_rs/{any}',                       [ItemDbController::class,'route'])->where('any','.*');
Route::any('/services/m=forum{rest}', fn($rest) =>
    redirect(rtrim(env('XENFORO_URL'),'/').$rest, 301))->where('rest','.*');
Route::view('/wilderness.html', 'pages.wilderness');           // and similar legal/static
Route::get('/{world}/{stub}.html', [GameLaunchController::class,'redirect'])
    ->where(['world'=>'world(8|14)','stub'=>',j0,f\d+']);
Route::view('/classicapplet/playclassic.html','gamelaunch.classic');
Route::view('/game.html','gamelaunch.index');
Route::view('/game-autocreate-true.html','gamelaunch.index');
```

The forum wildcard must be registered before any other `m=forum*` rule.

### 4. Database schema (app DB migrations)

`database/migrations/`:

- `news_items` — `id, legacy_id (unique), slug, title, body_html, author, published_at, summary`
- `devblog_posts` — `id, slug, title, body_html, author, published_at, hero_image`
- `kb_categories` — `id, name, slug, parent_id`
- `kb_articles` — `id, slug (unique), title, category_id, body_html, search_text (FULLTEXT), legacy_path`
- `competitions` — `id, slug, title, body_html, starts_at, ends_at`
- `support_tickets` — `id, user_account_id, category, subject, body, status`
- `displayname_changes` — `id, user_account_id, old_name, new_name, requested_at, applied_at`
- `hottopics` — `id, position, label, url`
- `sessions` — Laravel default
- `xenforo_sso_tokens` (only if API-based bridge) — `user_account_id, token, expires_at`

Game DB (`pgsql_game`) is **not** managed by migrations.

### 5. Models & repositories

`app/Models/`:
- `NewsItem`, `DevblogPost`, `KbArticle`, `KbCategory`, `Competition`, `SupportTicket`, `DisplaynameChange`, `HotTopic` — default connection.
- `GameAccount` — `protected $connection = 'pgsql_game'; protected $table = 'accounts';` implements `Authenticatable`.
- `GameCharacter`, `HiscoreEntry` — read-only on `pgsql_game`.

`app/Repositories/`:
- `HiscoresRepository::topByOverall(int $limit)`, `topBySkill(int $skillId, int $limit)`, `rankFor(string $username, int $skillId)` — uses Postgres `RANK() OVER (ORDER BY xp DESC)`.
- `ItemDbRepository::search(string $q)`, `find(int $itemId)`, `categories()`.
- `AdventurersLogRepository::profile(string $username)`, `recentActivity(string $username, int $n=10)`.
- `KbaseRepository` — FULLTEXT search on `kb_articles.search_text` + category filter.

Bind via `app/Providers/AppServiceProvider.php`.

### 6. Authentication

`config/auth.php`:
```php
'providers' => [
    'game' => ['driver' => 'game-postgres', 'model' => App\Models\GameAccount::class],
],
'guards'   => ['web' => ['driver' => 'session', 'provider' => 'game']],
```

- `app/Auth/GameUserProvider.php` extends `EloquentUserProvider`; overrides `validateCredentials()` to call `GamePasswordHasher::check()`.
- `app/Auth/GamePasswordHasher.php` — strategy switchable via `GAME_PASSWORD_ALGO`. Default bcrypt; alternates: sha256, argon2, jagex-custom. **Confirm with user.**
- Register provider in `AuthServiceProvider::boot()` via `Auth::provider('game-postgres', ...)`.

**Xenforo SSO bridge** (`app/Services/XenforoBridge.php`):
- **Recommended:** shared cookie + direct write to `xf_session` (look up `xf_user.user_id` by username, INSERT a serialized session row, set `xf_session` cookie on parent domain).
- Alternates: Xenforo API endpoint, or signed-JWT external-auth addon.
- Set `config/session.php` `domain` to parent domain (e.g. `.example.com`).
- Trigger via `Login`/`Logout` event listeners in `EventServiceProvider`.

### 7. Views

Layouts (`resources/views/layouts/`):
- `app.blade.php` — extracted from `_legacy/index.html` (head, top nav, footer, `@yield('content')`). References original `/css/global-38.css` etc. literally.
- `secure.blade.php` (uses `weblogin-9.css`), `kbase.blade.php` (uses `kbase-32.css`), `jagex.blade.php`.

Page views (one-time conversion from `_legacy/`):
- `home.blade.php` — `HomeController` passes latest 3 `NewsItem`s + `HotTopic::orderBy('position')`.
- `pages/{wilderness,splash,options,parents,cookies,account_management,email_registration,golden_joystick,competition_details}.blade.php`.
- `services/news/{index,item,rss}.blade.php`, `services/devblog/{index,item}.blade.php`.
- `kbase/{article,search,category,not_found}.blade.php`.
- `secure/weblogin/{form,members}.blade.php`.
- `secure/billing/{paymentoptions,userdetails,unsubscribe}.blade.php` — replace `<form>`s with a `<div class="notice">All membership benefits are free on this server.</div>` block; keep surrounding chrome.
- `secure/displaynames/name.blade.php`, `secure/ticketing/{billingsupport,billingsupport_cat7}.blade.php`.
- `members/index.blade.php`.
- `legal/{rule,terms,privacy,terms_cty}.blade.php`.
- `gamelaunch/{index,classic}.blade.php`.

### 8. Asset pipeline

No build step for legacy assets — they live verbatim under `public/`. Default Laravel `.htaccess` already routes non-existent paths to `index.php`, so `/css/global-38.css` resolves directly. **Do not** import legacy CSS through Vite (would rewrite `url(...)` references). Reserve Vite for any new SCSS/JS additions.

### 9. KB import

`app/Console/Commands/KbaseImport.php` — `kbase:import {--dry-run} {--purge}`.

1. Pre-pass: import `_legacy/kbase/view-guid-*.html` to populate `kb_categories` and a slug→category map.
2. For each `_legacy/kbase/guid/*.html`, parse with `Symfony\Component\DomCrawler\Crawler`:
   - `title` from first `<h1 class="plaque">` (fallback `<title>` minus prefix).
   - `category` from `<select name="category">` selected option, or the slug→category map.
   - `body_html` from `div.article` innerHTML.
   - `slug` from filename minus `.html`.
   - `search_text` = `strip_tags(title . ' ' . body)`.
3. Upsert into `kb_articles` keyed on `slug`.
4. With `--purge`, delete `_legacy/kbase/guid/`.
5. Verify `SELECT count(*) FROM kb_articles` = 1231.

### 10. News / Devblog import

`app/Console/Commands/NewsImport.php`, `DevblogImport.php`. Same Crawler approach:
- News: parse `_legacy/services/m=news/*.html`. Extract `legacy_id` from `newsitem-id-(\d+)`. Title = `<h2>`, body = main content `<div>`, `published_at` = `<span class="date">` via `Carbon::parse`. Cross-reference `latest_news.rss` for any missing dates.
- Devblog: parse `_legacy/services/m=devblog/*.html`; copy `images/` to `public/services/m=devblog/images/`.

### 11. Game launch page

`resources/views/gamelaunch/index.blade.php` — server-side OS detection (UA regex in `GameLaunchController`); offers `/downloads/runescape-261110.msi` (Win), `/downloads/RuneScape-20090424.exe` (legacy installer), `/downloads/jagexlauncher-src-261110.bz2` (other).

`GameLaunchController::redirect()` handles `/world8/*`, `/world14/*`, `/game.html`, `/game-autocreate-true.html` — render the launcher view (preserves URL).

### 12. Forum redirects

Already covered in §3 — single wildcard route 301s `/services/m=forum*` to Xenforo.

---

## Critical files

- `routes/web.php` (+ `routes/modules/*.php`)
- `config/database.php`, `config/auth.php`, `config/session.php`
- `app/Auth/GameUserProvider.php`, `app/Auth/GamePasswordHasher.php`
- `app/Services/XenforoBridge.php`
- `app/Models/GameAccount.php`, `NewsItem.php`, `KbArticle.php`, ...
- `app/Repositories/{Hiscores,ItemDb,AdventurersLog,Kbase}Repository.php`
- `app/Console/Commands/{Kbase,News,Devblog}Import.php`
- `resources/views/layouts/{app,secure,kbase,jagex}.blade.php`
- `database/migrations/*`

## Assumptions to confirm with user before/during implementation

1. **Postgres `accounts` schema** — exact table/column names (assumed `accounts(id, username, password, email, created_at)`).
2. **Password hash format** — bcrypt vs sha256 vs custom Jagex scheme. Inspect one row.
3. **Game DB tables** for skills/XP per character, item definitions, adventurer's-log activity.
4. **Xenforo location** — same DB host? MySQL or Postgres? Which SSO mechanism (cookie/DB vs API vs JWT addon)?
5. **Domain layout** — is forum on a subdomain of the site? Required for shared-cookie SSO.
6. **News archive completeness** — only one news ID found in static dump (3889). More elsewhere?
7. **Display-name changes** — write directly to game DB or queue for moderation?
8. **`jagex.com/`** — keep as verbatim corporate pages or rebrand?

## Verification

1. `composer install && php artisan key:generate && php artisan migrate`.
2. `php artisan db:show --database=pgsql_game` — confirm read-only Postgres connectivity.
3. `php artisan kbase:import && php artisan news:import && php artisan devblog:import`.
4. `php artisan route:list` — confirm every legacy URL is mapped.
5. `php artisan serve` and smoke-test in browser:
   - `/` — homepage, slider, news links resolve.
   - `/services/m=news/newsitem-id-3889.html` — renders.
   - `/kbase/search.html?q=wilderness` → click hit → article renders with original styling.
   - `/services/m=hiscore/ranking.ws` — top players from Postgres.
   - `/services/m=itemdb_rs/...` — item search works.
   - `/services/m=adventurers-log/a={knownuser}/main.ws` — profile loads.
   - `/secure/m=weblogin/loginform.html` POST with seeded Postgres test account → session + Xenforo cookies set; visit forum URL, confirm logged in.
   - `/secure/m=billing_core/paymentoptions.html` — shows "free on this server" notice.
   - `/services/m=forum/forums.ws` — 301s to Xenforo.
   - `/world8/,j0,f13.html`, `/game.html`, `/classicapplet/playclassic.html` — all hit launcher.
   - `/jagex.com/careers.html`, `/rules/rule_account_sharing.html`, `/terms/eu.html` — render.
6. `wget --spider -r -l2 http://localhost:8000/` against an inventory of legacy URLs — look for 404s.
