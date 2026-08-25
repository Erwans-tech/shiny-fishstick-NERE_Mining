FROM php:8.3-fpm-alpine

# ── Dépendances système ──────────────────────────────────────
RUN apk add --no-cache \
    nginx \
    supervisor \
    nodejs \
    npm \
    curl \
    zip \
    unzip \
    git \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    postgresql-client \
    libpq-dev

# ── Extensions PHP ───────────────────────────────────────────
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
 && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        xml \
        opcache

# ── Composer ─────────────────────────────────────────────────
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# ── Répertoire de travail ────────────────────────────────────
WORKDIR /var/www/html

# ── Dépendances Composer (layer mis en cache) ────────────────
COPY composer.json composer.lock ./
RUN composer install \
        --no-dev \
        --optimize-autoloader \
        --no-scripts \
        --no-interaction \
        --prefer-dist

# ── Code source ──────────────────────────────────────────────
COPY . .

# ── Assets front-end ────────────────────────────────────────
RUN npm ci --ignore-scripts && npm run build && rm -rf node_modules

# ── Permissions Laravel ──────────────────────────────────────
RUN mkdir -p \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
        public/uploads \
 && chown -R www-data:www-data \
        storage \
        bootstrap/cache \
        public/uploads \
 && chmod -R 775 \
        storage \
        bootstrap/cache \
        public/uploads

# ── Config nginx ──────────────────────────────────────────────
COPY docker/nginx.conf /etc/nginx/nginx.conf

# ── Supervisord ──────────────────────────────────────────────
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# ── Script de démarrage ──────────────────────────────────────
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

# ── OPcache prod ─────────────────────────────────────────────
RUN { \
        echo "opcache.enable=1"; \
        echo "opcache.memory_consumption=128"; \
        echo "opcache.max_accelerated_files=10000"; \
        echo "opcache.validate_timestamps=0"; \
    } > /usr/local/etc/php/conf.d/opcache.ini

EXPOSE 80

CMD ["/start.sh"]
