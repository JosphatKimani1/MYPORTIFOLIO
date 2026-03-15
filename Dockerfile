FROM dunglas/frankenphp:latest

WORKDIR /app

# copy composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copy project files
COPY . .

# copy caddy configuration
COPY Caddyfile /etc/caddy/Caddyfile

# install laravel dependencies
RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:cache
RUN php artisan route:cache

ENV PORT=8080

EXPOSE 8080