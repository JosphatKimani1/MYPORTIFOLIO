# Use FrankenPHP
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

# Set working directory
WORKDIR /app

# Copy project
COPY . .

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Laravel public root
ENV FRANKENPHP_ROOT=/app/public

# Start server
CMD frankenphp php-server --listen :$PORT --root /app/public