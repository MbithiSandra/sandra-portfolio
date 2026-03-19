FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev \
    libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

EXPOSE 8080

CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php -S 0.0.0.0:8080 -t public
