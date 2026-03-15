# 1. Use the official FrankenPHP image
FROM dunglas/frankenphp:php8.2.30-bookworm

# 2. Install system dependencies (Debian/Apt style)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    bash \
    && rm -rf /var/lib/apt/lists/*

# 3. Install PHP extensions required by Laravel
RUN install-php-extensions \
    gd \
    intl \
    zip \
    pcntl \
    pdo_mysql \
    bcmath

# 4. Set the working directory
WORKDIR /app

# 5. Copy the application code
COPY . .

# 6. Copy Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev --no-scripts

# 8. Set permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# 9. Method 1: Use Shell Form for the Start Command
# This allows $PORT to be expanded into the actual port number (e.g., 8080)
CMD frankenphp php-server --listen :$PORT --root public/