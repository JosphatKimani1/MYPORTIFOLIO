# 1. Base image
FROM dunglas/frankenphp:php8.2-bookworm

# 2. System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    bash \
    && rm -rf /var/lib/apt/lists/*

# 3. PHP extensions
RUN install-php-extensions \
    gd \
    intl \
    zip \
    pcntl \
    pdo_mysql \
    bcmath \
    mbstring

# 4. Copy Composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 5. Set working directory
WORKDIR /app

# 6. Copy only composer files first (for caching)
COPY composer.json composer.lock ./

# 7. Install Laravel dependencies, skip scripts that require DB
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 8. Copy remaining app files
COPY . .

# 9. Create SQLite DB if using sqlite
RUN mkdir -p database && touch database/database.sqlite || true

# 10. Clear caches (skip DB-dependent cache if sqlite not used)
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear

# 11. Fix permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# 12. Laravel public root
ENV FRANKENPHP_ROOT=/app/public

# 13. Start server
CMD frankenphp php-server --listen :$PORT --root /app/public