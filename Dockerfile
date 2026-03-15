FROM dunglas/frankenphp:php8.2.30-bookworm

# 1. Install system dependencies (Debian/Apt)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    bash \
    && rm -rf /var/lib/apt/lists/*

# 2. Install PHP extensions required by Laravel
RUN install-php-extensions gd intl zip pcntl pdo_mysql bcmath

# 3. Set Working Directory
WORKDIR /app

# 4. Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copy composer files and install dependencies
# We do this BEFORE copying the rest of the code to speed up builds
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# 6. Copy the rest of the application code
COPY . .

# 7. Finalize Composer (generate the optimized class map)
RUN composer dump-autoload --optimize

# 8. Fix Permissions for Laravel
# FrankenPHP runs as 'www-data', so it must own these folders
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# 9. Start Command
CMD frankenphp php-server --listen :$PORT --root public/