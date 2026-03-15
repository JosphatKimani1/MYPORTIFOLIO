FROM dunglas/frankenphp:php8.2.30-bookworm

# 1. Install system dependencies (Debian/Apt)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    bash \
    && rm -rf /var/lib/apt/lists/*

# 2. Install PHP extensions
RUN install-php-extensions gd intl zip pcntl pdo_mysql bcmath

# 3. Set Working Directory
WORKDIR /app

# 4. Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copy composer files FIRST
COPY composer.json composer.lock ./

# 6. Install dependencies (This creates the vendor folder)
# We use --ignore-platform-reqs just in case there's a version mismatch
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction --ignore-platform-reqs

# 7. Copy the rest of the application
COPY . .

# 8. Finalize autoloader
RUN composer dump-autoload --optimize

# 9. Fix Permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# 10. Start Command (Ensure absolute path to root)
CMD frankenphp php-server --listen :$PORT --root /app/public