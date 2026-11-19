#!/bin/sh
set -e

# Railway injects $PORT; default to 80 when running locally.
APP_PORT="${PORT:-80}"

# Make Apache listen on the port Railway expects.
sed -i "s/^Listen 80$/Listen ${APP_PORT}/" /etc/apache2/ports.conf
sed -i "s/:80>/:${APP_PORT}>/" /etc/apache2/sites-available/000-default.conf

# Ensure only one MPM (mpm_prefork) is loaded to prevent AH00534
rm -f /etc/apache2/mods-enabled/mpm_*.load /etc/apache2/mods-enabled/mpm_*.conf
a2enmod mpm_prefork 2>/dev/null || ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load
if [ -f /etc/apache2/mods-available/mpm_prefork.conf ] && [ ! -f /etc/apache2/mods-enabled/mpm_prefork.conf ]; then
    ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf 2>/dev/null || true
fi

# Runtime dirs the app writes to (views/cache/logs + user uploads).
mkdir -p storage/framework/cache/data \
         storage/framework/sessions \
         storage/framework/views \
         storage/logs \
         storage/app/public \
         storage/app/livewire-tmp \
         bootstrap/cache

# Ensure www-data can write (fresh container / mounted volume).
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true
chmod -R ug+rwX storage bootstrap/cache 2>/dev/null || true

# Apache accepts exactly one MPM and mod_php requires prefork. These images can
# end up with mpm_event enabled alongside it, which aborts startup with
# "AH00534: More than one MPM loaded". Clear the MPM links, re-enable only
# prefork, and log the resulting state so a failure is diagnosable.
rm -f /etc/apache2/mods-enabled/mpm_*.load /etc/apache2/mods-enabled/mpm_*.conf
a2enmod mpm_prefork >/dev/null 2>&1 || true
echo "[start] mpm modules: $(ls /etc/apache2/mods-enabled | grep -i mpm | tr '\n' ' ')"
grep -rn 'LoadModule mpm' /etc/apache2 2>/dev/null || true
apache2ctl -t 2>&1 || true

exec apache2-foreground
