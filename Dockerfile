FROM php:8.2-apache

# Install extension yang dibutuhkan Yii
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable rewrite
RUN a2enmod rewrite
RUN a2dismod mpm_event || true \
    && a2dismod mpm_worker || true \
    && a2dismod mpm_prefork || true \
    && a2enmod mpm_prefork
RUN sed -i 's!/var/www/html!/var/www/html/web!g' /etc/apache2/sites-available/000-default.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project
COPY . /var/www/html/

WORKDIR /var/www/html

# Install dependency Yii
RUN composer install --no-dev --optimize-autoloader

# ✅ WAJIB ADA INI (FIX ERROR)
RUN mkdir -p /var/www/html/runtime /var/www/html/web/assets \
    && chown -R www-data:www-data /var/www/html/runtime /var/www/html/web/assets \
    && chmod -R 775 /var/www/html/runtime /var/www/html/web/assets
# 🔥 FIX PORT RAILWAY
CMD sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf && \
    sed -i "s/:80/:${PORT}/" /etc/apache2/sites-available/000-default.conf && \
    apache2-foreground
EXPOSE 80