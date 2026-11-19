#!/bin/sh
set -e

# Railway injects $PORT; default to 80 when running locally.
APP_PORT="${PORT:-80}"

# Make Apache listen on the port Railway expects.
sed -i "s/^Listen 80$/Listen ${APP_PORT}/" /etc/apache2/ports.conf
sed -i "s/:80>/:${APP_PORT}>/" /etc/apache2/sites-available/000-default.conf

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

exec apache2-foreground
