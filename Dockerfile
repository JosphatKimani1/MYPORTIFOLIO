FROM dunglas/frankenphp:latest

WORKDIR /app

# install required PHP extensions
RUN install-php-extensions gd intl

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copy project files
COPY . .

# copy caddy configuration
COPY Caddyfile /etc/caddy/Caddyfile

# install laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# create laravel writable directories
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 8080