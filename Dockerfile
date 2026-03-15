# 1. Use the official FrankenPHP image
FROM dunglas/frankenphp:php8.2.30-bookworm

# 2. Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    bash \
    && rm -rf /var/lib/apt/lists/*

RUN install-php-extensions \
    gd \
    intl \
    zip \
    pcntl \
    pdo_mysql \
    bcmath \
    mbstring \
    xml

# 3. Set the working directory
WORKDIR /app

# 4. Copy the application code
COPY . .

# 5. Create a dummy SQLite file to satisfy Laravel's build-time checks
RUN mkdir -p database && touch database/database.sqlite

# 6. Set permissions so the web user owns the files
RUN chown -R www-data:www-data /app

# 7. Copy Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 8. Install dependencies as the www-data user
# We set DB_CONNECTION=null to prevent Laravel from trying to connect to a DB during build
USER www-data
RUN DB_CONNECTION=null composer install --no-dev --optimize-autoloader

# 9. Switch back to root for the final container execution
USER root

# 10. Expose the port FrankenPHP uses
EXPOSE 8080

# 11. Final entrypoint (FrankenPHP handles this, but you can specify a start command)
CMD ["frankenphp", "php-server", "--worker", "public/index.php"]