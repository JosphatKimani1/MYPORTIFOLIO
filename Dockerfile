FROM dunglas/frankenphp

WORKDIR /app

COPY . .

COPY Caddyfile /etc/caddy/Caddyfile

RUN composer install --no-dev --optimize-autoloader

ENV PORT=8080

EXPOSE 8080

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]