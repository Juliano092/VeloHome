FROM php:8.4-cli

# Instala dependências do sistema e extensões necessárias do PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Limpa o cache de pacotes
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# Copia os arquivos do projeto
COPY . .

# Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Prepara diretórios de cache e storage do Laravel
RUN mkdir -p /var/www/storage/framework/sessions \
    /var/www/storage/framework/views \
    /var/www/storage/framework/cache \
    /var/www/bootstrap/cache

# Ajusta permissões
RUN chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Expõe a porta que o Render utiliza
EXPOSE 8080

# Copia .env.example para .env se não existir no container
RUN cp -n .env.example .env || true

# Script de inicialização seguro (Cria SQLite, roda migrations, gera key e inicia servidor)
CMD cp .env.example .env && touch /var/www/database/database.sqlite && chmod -R 777 /var/www/database && php artisan storage:link --force && php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
