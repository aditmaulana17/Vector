# =========================================================
# STAGE 1 - BUILD FRONTEND
# =========================================================
FROM node:22-alpine AS frontend

WORKDIR /var/www/html

# Copy package files
COPY package.json package-lock.json ./

# Install frontend dependencies
RUN npm ci

# Copy seluruh source project
COPY . .

# Build Vite
RUN npm run build


# =========================================================
# STAGE 2 - LARAVEL APPLICATION
# =========================================================
FROM php:8.3-fpm-alpine

WORKDIR /var/www/html


# =========================================================
# SYSTEM DEPENDENCIES
# =========================================================
RUN apk add --no-cache \
    bash \
    curl \
    git \
    unzip \
    zip \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    mysql-client \
    nginx \
    supervisor


# =========================================================
# PHP EXTENSIONS
# =========================================================
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
        opcache


# =========================================================
# COMPOSER
# =========================================================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


# =========================================================
# COPY LARAVEL APPLICATION
# =========================================================
COPY . .


# =========================================================
# COPY FRONTEND BUILD
# =========================================================
COPY --from=frontend /var/www/html/public/build ./public/build


# =========================================================
# INSTALL COMPOSER DEPENDENCIES
# =========================================================
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-progress


# =========================================================
# CREATE LARAVEL DIRECTORIES
# =========================================================
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache


# =========================================================
# PERMISSIONS
# =========================================================
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache \
    && chmod -R 775 \
    storage \
    bootstrap/cache


# =========================================================
# NGINX CONFIGURATION
# =========================================================
RUN rm -f /etc/nginx/http.d/default.conf

COPY docker/nginx/default.conf \
    /etc/nginx/http.d/default.conf


# =========================================================
# SUPERVISOR CONFIGURATION
# =========================================================
COPY docker/supervisord.conf \
    /etc/supervisord.conf


# =========================================================
# PORT
# =========================================================
EXPOSE 8097


# =========================================================
# START NGINX + PHP-FPM
# =========================================================
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]