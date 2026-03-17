FROM dunglas/frankenphp:php8.2-bookworm

# Install PHP extensions
RUN install-php-extensions \
    gd \
    intl \
    zip \
    pcntl \
    pdo_mysql \
    bcmath \
    mbstring

# Install Composer
RUN apt-get update && apt-get install -y curl unzip \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /app

# Copy composer files first (for caching)
COPY composer.json composer.lock ./

RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy rest of app
COPY . .

# SQLite setup
RUN mkdir -p database && touch database/database.sqlite || true

# 🔥 CRITICAL FIX (Laravel serving)
WORKDIR /app/public