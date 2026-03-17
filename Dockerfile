FROM dunglas/frankenphp:php8.2-bookworm

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

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .

RUN mkdir -p database && touch database/database.sqlite || true

# ✅ Use correct Caddy config
COPY Caddyfile /etc/caddy/Caddyfile