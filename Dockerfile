FROM php:8.2-apache

# Install dependency
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable apache modules
RUN a2enmod rewrite

# Fix MPM (pakai prefork saja)
RUN a2dismod mpm_event || true \
    && a2dismod mpm_worker || true \
    && a2enmod mpm_prefork

# Set document root ke Yii web/
RUN sed -i 's!/var/www/html!/var/www/html/web!g' /etc/apache2/sites-available/000-default.conf

# Allow .htaccess
RUN sed -i '/<Directory \/var\/www\/>/,/AllowOverride/c\<Directory \/var\/www\/>\n\tAllowOverride All\n<\/Directory>' /etc/apache2/apache2.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project
COPY . /var/www/html/

WORKDIR /var/www/html

# Install Yii dependency
RUN composer install --no-dev --optimize-autoloader

# Fix folder Yii
RUN mkdir -p runtime web/assets \
    && chown -R www-data:www-data runtime web/assets \
    && chmod -R 775 runtime web/assets

EXPOSE 80

CMD ["apache2-foreground"]