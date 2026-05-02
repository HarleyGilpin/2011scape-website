# Production install — `world2` (Apache 2.4 + PHP-FPM + Postgres)

Confirmed inventory: Linux (Debian/Ubuntu, `apt`), Apache 2.4.52,
XenForo 2 already at `/var/www/html/services/m=forum/`, root shell.

Steps run as a sudo-capable user. Replace `<owner>`, `<set>`, and
`<from local .env>` placeholders before pasting.

## 1. Pre-flight cleanup of the XF dir

```bash
sudo rm -rf /var/www/html/services/m=forum/install     # XF removes after install/upgrade
sudo rm     /var/www/html/services/m=forum/data.zip    # stray upload artifact
sudo rm -rf /var/www/html/services/m=forum/library     # XF1 leftover, not loaded by index.php
```

## 2. System packages

```bash
sudo apt update && sudo apt install -y \
    php-cli php-fpm php-pgsql php-mbstring php-xml php-zip php-curl php-intl \
    composer postgresql git certbot python3-certbot-apache

sudo a2enmod rewrite headers alias ssl proxy_fcgi setenvif
sudo a2dismod php8.3 mpm_prefork 2>/dev/null || true   # if mod_php was on
sudo a2enmod mpm_event
sudo systemctl restart apache2
```

Sanity:

```bash
php -v | head -1                                                # PHP 8.2+
php -m | grep -E '^(pdo_pgsql|mbstring|tokenizer|curl)$'        # all present
apache2ctl -M | grep -E 'rewrite|headers|alias|ssl|proxy_fcgi'  # all loaded
```

## 3. Postgres

```bash
sudo -u postgres createuser site2011 --pwprompt
sudo -u postgres createdb site2011 --owner=site2011

# Grant the website read on the live game DB. Adjust the DB / role names
# to match your void deployment.
sudo -u postgres psql -d game -c 'GRANT CONNECT ON DATABASE game TO site2011;'
sudo -u postgres psql -d game -c 'GRANT USAGE ON SCHEMA public TO site2011;'
sudo -u postgres psql -d game -c 'GRANT SELECT ON ALL TABLES IN SCHEMA public TO site2011;'
sudo -u postgres psql -d game -c 'ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT SELECT ON TABLES TO site2011;'
```

If display-name writeback is enabled, also create a writer role and
grant `INSERT, UPDATE` on `variables`:

```bash
sudo -u postgres createuser site2011_writer --pwprompt
sudo -u postgres psql -d game -c 'GRANT CONNECT ON DATABASE game TO site2011_writer;'
sudo -u postgres psql -d game -c 'GRANT USAGE ON SCHEMA public TO site2011_writer;'
sudo -u postgres psql -d game -c 'GRANT INSERT, UPDATE ON variables TO site2011_writer;'
sudo -u postgres psql -d game -c 'GRANT USAGE ON ALL SEQUENCES IN SCHEMA public TO site2011_writer;'
```

## 4. Clone + composer

```bash
sudo mkdir -p /var/www/2011scape-website
sudo chown $USER:www-data /var/www/2011scape-website
git clone https://github.com/<owner>/2011scape-website /var/www/2011scape-website
cd /var/www/2011scape-website
composer install --no-dev --optimize-autoloader --no-interaction
```

## 5. `.env`

Copy `.env.example` to `.env` and fill:

```ini
APP_NAME="2011scape"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://2011.rs
APP_KEY=

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_DATABASE=site2011
DB_USERNAME=site2011
DB_PASSWORD=<set>

GAME_DB_HOST=127.0.0.1
GAME_DB_DATABASE=game
GAME_DB_USERNAME=site2011
GAME_DB_PASSWORD=<set>
GAME_DB_WRITE_USERNAME=site2011_writer
GAME_DB_WRITE_PASSWORD=<set>

GAME_LOG_DIR=/path/to/void/data/saves/logs
GAME_TOML_DIR=/path/to/void/data
GAME_ITEMS_JSON=storage/app/items.json

XENFORO_URL=https://2011.rs/services/m=forum
XENFORO_API_KEY=<from local .env, already issued>
XENFORO_API_USER=1
XENFORO_COOKIE_PREFIX=xf_

SESSION_DRIVER=database
SESSION_DOMAIN=null
SESSION_SAME_SITE=lax
```

```bash
php artisan key:generate
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 6. Schema + content

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan kbase:import         # expect "kb_articles total: 1231"
php artisan items:import         # expect ~10171 items
php artisan game:discover        # confirms accounts schema matches GameAccount
php artisan xf:check             # validates XENFORO_API_KEY against /api/me + /api/index
```

## 7. Permissions

Apache runs as `www-data`. Lock files down, then loosen `storage/` and
`bootstrap/cache/` so the framework can write logs and compiled views.

```bash
sudo chown -R $USER:www-data /var/www/2011scape-website
sudo find /var/www/2011scape-website -type d -exec chmod 0755 {} \;
sudo find /var/www/2011scape-website -type f -exec chmod 0644 {} \;
sudo chmod -R ug+rwX /var/www/2011scape-website/storage \
                       /var/www/2011scape-website/bootstrap/cache
sudo chmod 0640 /var/www/2011scape-website/.env
```

## 8. Apache vhost

```bash
sudo ln -sf /var/www/2011scape-website/deploy/apache/2011.rs.conf \
            /etc/apache2/sites-available/2011.rs.conf
sudo a2ensite 2011.rs
sudo a2dissite 000-default default-ssl 2>/dev/null || true
sudo apache2ctl configtest && sudo systemctl reload apache2
```

## 9. TLS (Let's Encrypt)

```bash
sudo certbot --apache -d 2011.rs -d www.2011.rs
```

## 10. Smoke test

```bash
curl -sI https://2011.rs/                          | head -1   # 200
curl -sI https://2011.rs/services/m=forum/         | grep -iE 'set-cookie: xf_'
curl -sI https://2011.rs/wilderness.html           | head -1   # 200, served by Laravel
curl -sI https://2011.rs/css/global-38.css         | grep -i 'cache-control: public, immutable'
curl -sI https://2011.rs/.env                      | head -1   # 403
```

Then in a real browser:

1. `/secure/m=weblogin/loginform.html` — submit a real game-account
   credential. Should redirect to `/secure/m=weblogin/members/members.html`
   and the response should set both `xf_user` and `xf_session` cookies.
2. Visit `/services/m=forum/` — should already be logged-in as that user.
3. Logout — cookies cleared on both sides.

## Updates / redeploys

```bash
cd /var/www/2011scape-website
sudo -u $USER git pull
composer install --no-dev --optimize-autoloader --no-interaction
php artisan migrate --force
php artisan config:cache && php artisan route:cache && php artisan view:cache
sudo systemctl reload php8.3-fpm
```

## Removing `_legacy/` after parity is verified

```bash
git checkout -b legacy-static-archive
git push origin legacy-static-archive
git checkout main
git rm -rf _legacy/
git commit -m "drop _legacy after parity"
git push
```
