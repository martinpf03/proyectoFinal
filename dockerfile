FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev libzip-dev zip

RUN docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# 🔥 Crear .env
RUN cp .env.example .env

# Instalar Laravel
RUN composer install --no-dev --optimize-autoloader

# Permisos
RUN chmod -R 775 storage bootstrap/cache

# Limpiar cache viejo
RUN rm -f bootstrap/cache/*.php

EXPOSE 10000

CMD php artisan config:clear && php artisan cache:clear && php artisan migrate --force && php -S 0.0.0.0:10000 -t public
