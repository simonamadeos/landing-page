FROM php:8.2-cli

# Install dependency
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project
COPY . /app
RUN ls -la /app/config

WORKDIR /app

# Install Yii dependency
RUN composer install --no-dev --optimize-autoloader

# Fix folder Yii
RUN mkdir -p runtime web/assets \
    && chmod -R 777 runtime web/assets

# Jalankan server PHP langsung
CMD php -S 0.0.0.0:${PORT:-80} -t web