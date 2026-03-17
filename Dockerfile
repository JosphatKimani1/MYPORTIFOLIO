FROM dunglas/frankenphp:php8.2-bookworm

RUN install-php-extensions \
    gd \
    intl \
    zip \
    pcntl \
    pdo_mysql \
    bcmath \
    mbstring

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .

RUN mkdir -p database && touch database/database.sqlite || true

# 🔥 THIS IS THE IMPORTANT PART
WORKDIR /app/public