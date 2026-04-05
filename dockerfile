FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev libzip-dev zip

RUN docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD php artisan config:clear && php artisan cache:clear && php artisan key:generate --force && php artisan migrate --force && php -S 0.0.0.0:10000 -t public
