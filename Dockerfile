# Dockerfile
FROM php:8.1-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /app

# Copiar archivos
COPY . .

# Instalar dependencias
RUN composer install --optimize-autoloader

# Generar caches
RUN php artisan config:cache && php artisan route:cache

# Exponer puerto
EXPOSE 8080

# Comando de inicio
CMD php artisan migrate --seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
