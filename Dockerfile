# -------- 1. Base Image --------
FROM dunglas/frankenphp:php8.2-bookworm

# -------- 2. Install system packages --------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# -------- 3. Install required PHP extensions --------
RUN install-php-extensions \
    pdo_mysql \
    gd \
    intl \
    zip \
    bcmath \
    opcache \
    pcntl

# -------- 4. Install Composer --------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -------- 5. Set working directory --------
WORKDIR /app

# -------- 6. Copy composer files first (better caching) --------
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# -------- 7. Copy application code --------
COPY . .

# -------- 8. Set correct permissions --------
RUN chown -R www-data:www-data storage bootstrap/cache

# -------- 9. Laravel optimization --------
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache || true

# -------- 10. Tell FrankenPHP where Laravel public folder is --------
ENV FRANKENPHP_ROOT=/app/public

# -------- 11. Start server --------
CMD frankenphp php-server --listen :$PORT --root /app/public