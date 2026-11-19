# Secure Save Hub - Laravel 8 (root-deployed) on Apache + PHP 8.1
FROM php:8.1-apache

# --- PHP extensions required by this app (including GMP for BitPay) ---
RUN apt-get update && apt-get install -y --no-install-recommends \
        libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev libonig-dev libgmp-dev unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql mysqli mbstring zip gd bcmath exif gmp opcache pcntl \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# --- Let the app's .htaccess (front controller) work in the document root ---
RUN printf '<Directory /var/www/html>\n    Options FollowSymLinks\n    AllowOverride All\n    Require all granted\n</Directory>\n' \
        > /etc/apache2/conf-available/app-overrides.conf \
    && a2enconf app-overrides

# --- Sensible PHP limits for KYC / document uploads ---
RUN printf 'upload_max_filesize = 12M\npost_max_size = 16M\nmemory_limit = 256M\nmax_execution_time = 300\n' \
        > /usr/local/etc/php/conf.d/app.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Dependencies first (own layer, so app edits don't re-download packages).
# --no-scripts: the app is booted at runtime, not during the image build.
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-progress --prefer-dist \
        --optimize-autoloader --no-scripts

COPY . .

COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 8080

CMD ["/usr/local/bin/start.sh"]
