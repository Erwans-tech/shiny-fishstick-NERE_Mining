FROM php:8.4-fpm-alpine

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
        icu-dev \
        postgresql-client \
        su-exec

# ── Extensions PHP ───────────────────────────────────────────
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        intl \
        gd \
        xml \
        opcache

# ── PHP-FPM : écouter sur TCP 127.0.0.1:9000 ────────────────
# Évite les problèmes de permissions sur les sockets Unix
RUN echo '[www]'                              >  /usr/local/etc/php-fpm.d/www.conf \
 && echo 'user = www-data'                   >> /usr/local/etc/php-fpm.d/www.conf \
 && echo 'group = www-data'                  >> /usr/local/etc/php-fpm.d/www.conf \
 && echo 'listen = 127.0.0.1:9000'           >> /usr/local/etc/php-fpm.d/www.conf \
 && echo 'listen.owner = www-data'           >> /usr/local/etc/php-fpm.d/www.conf \
 && echo 'listen.group = www-data'           >> /usr/local/etc/php-fpm.d/www.conf \
 && echo 'pm = dynamic'                      >> /usr/local/etc/php-fpm.d/www.conf \
 && echo 'pm.max_children = 10'              >> /usr/local/etc/php-fpm.d/www.conf \
 && echo 'pm.start_servers = 2'              >> /usr/local/etc/php-fpm.d/www.conf \
 && echo 'pm.min_spare_servers = 1'          >> /usr/local/etc/php-fpm.d/www.conf \
 && echo 'pm.max_spare_servers = 4'          >> /usr/local/etc/php-fpm.d/www.conf \
 && echo 'pm.process_idle_timeout = 10s'     >> /usr/local/etc/php-fpm.d/www.conf

# ── Composer ─────────────────────────────────────────────────
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

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
        public/uploads/news \
        public/uploads/media \
        public/uploads/applications/cv \
        public/uploads/applications/cover \
        public/uploads/partners \
        public/uploads/press \
        public/uploads/reports/covers \
        public/uploads/hero \
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
        echo "opcache.revalidate_freq=0"; \
    } > /usr/local/etc/php/conf.d/opcache.ini

# Limites upload
RUN { \
        echo "upload_max_filesize=10M"; \
        echo "post_max_size=12M"; \
        echo "max_execution_time=120"; \
        echo "memory_limit=256M"; \
    } > /usr/local/etc/php/conf.d/prod.ini

# Port d'écoute par défaut (80 en production locale, surchargé par $PORT)
EXPOSE 80

CMD ["/start.sh"]
