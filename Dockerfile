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

    # ... (your previous installation steps)

# 1. Set the working directory
WORKDIR /app

# 2. Copy the application code
COPY . .

# 3. Ensure permissions are correct
RUN chown -R www-data:www-data storage bootstrap/cache

# 4. THE FIX: Use Shell Form (No brackets, no quotes)
# This allows the shell to replace $PORT with 8080 (or whatever Railway provides)
CMD frankenphp php-server --listen :$PORT --root public/