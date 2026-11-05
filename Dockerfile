# Stage 1: Build frontend assets (Vite / Tailwind)
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci || npm install
COPY . .
RUN npm run build

# Stage 2: Production PHP 8.4-FPM + Nginx (Server Side Up)
FROM serversideup/php:8.4-fpm-nginx

USER root

# Ensure PostgreSQL PHP extensions are installed
RUN install-php-extensions pdo_pgsql pgsql

# Copy application code
COPY --chown=www-data:www-data . /var/www/html

# Copy compiled frontend assets from Stage 1
COPY --chown=www-data:www-data --from=frontend /app/public/build /var/www/html/public/build

WORKDIR /var/www/html

USER www-data

# Install production PHP dependencies
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

EXPOSE 8080

