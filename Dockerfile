FROM dunglas/frankenphp:php8.2.30-bookworm

# 1. Install system dependencies
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

# 5. Copy ONLY composer files first (Efficiency trick)
COPY composer.json composer.lock ./

# 6. Install dependencies
# We use --no-scripts to prevent Laravel from trying to run code before 
# the rest of the files are copied.
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 7. Copy the rest of the application code
COPY . .

# 8. NOW run scripts (like generating the autoloader)
RUN composer dump-autoload --optimize

# 9. Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# 10. Start Command (Shell Form)
CMD frankenphp php-server --listen :$PORT --root public/