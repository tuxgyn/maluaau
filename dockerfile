FROM node:22-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install --no-audit --no-fund
COPY resources resources
COPY public public
COPY vite.config.js .
RUN npm run build

FROM php:8.3-apache
RUN apt-get update && apt-get install -y git unzip libzip-dev libpng-dev libicu-dev libonig-dev && docker-php-ext-install pdo_mysql mbstring bcmath exif pcntl gd intl zip && a2enmod rewrite
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
COPY --from=frontend /app/public/build public/build
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader && chown -R www-data:www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
EXPOSE 80
CMD ["apache2-foreground"]
