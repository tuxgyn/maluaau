FROM php:8.2-apache

# Instalar dependências do sistema e extensões do PHP necessárias para o Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd zip

# Habilitar o mod_rewrite do Apache para as rotas do Laravel
RUN a2enmod rewrite

# Definir o diretório de trabalho dentro do container
WORKDIR /var/www/html

# Copiar os arquivos do projeto para o container
COPY . /var/www/html

# Ajustar o DocumentRoot do Apache para a pasta 'public' do Laravel
RUN sed -ri -s 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -s 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Ajustar permissões para o usuário do Apache (www-data)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache