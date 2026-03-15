# Use FrankenPHP as base
FROM dunglas/frankenphp:latest

# Set working directory
WORKDIR /app

# Install PHP extensions needed by Laravel and composer dependencies
RUN install-php-extensions gd intl zip

# Install system utilities needed by composer
RUN apk add --no-cache git unzip bash

# Copy composer binary from official composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Copy Caddyfile if using Caddy server
COPY Caddyfile /etc/caddy/Caddyfile

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Create Laravel writable directories
RUN mkdir -p storage/framework storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache