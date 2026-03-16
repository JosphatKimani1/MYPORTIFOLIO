FROM dunglas/frankenphp:php8.2.30-bookworm

# Install system packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    bash \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN install-php-extensions \
    gd \
    intl \
    zip \
    pcntl \
    pdo_mysql \
    bcmath

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application code
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Set Laravel public root
ENV FRANKENPHP_ROOT=/app/public

RUN touch database/database.sqlite \
 && php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear

# Start server
CMD frankenphp php-server --listen :$PORT --root /app/public