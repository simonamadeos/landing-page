FROM php:8.2-apache

# Install extension yang dibutuhkan Yii
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip

# 🔥 RESET MODULE APACHE (hindari MPM conflict total)
RUN rm -rf /etc/apache2/mods-enabled/*

# Aktifkan module yang diperlukan saja
RUN a2enmod mpm_prefork rewrite dir mime

# Set document root ke Yii web/
RUN sed -i 's!/var/www/html!/var/www/html/web!g' /etc/apache2/sites-available/000-default.conf

# Aktifkan .htaccess (penting untuk Yii)
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project
COPY . /var/www/html/

WORKDIR /var/www/html

# Install dependency Yii
RUN composer install --no-dev --optimize-autoloader

# Fix folder wajib Yii
RUN mkdir -p runtime web/assets \
    && chown -R www-data:www-data runtime web/assets \
    && chmod -R 775 runtime web/assets

# Port default (Railway akan forward ke sini)
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]