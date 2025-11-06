# Dockerfile
FROM php:8.1-fpm

# Instalar dependencias del sistema incluyendo PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP (ahora con pdo_pgsql)
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /app

# Copiar archivos
COPY . .

# Instalar dependencias de PHP
RUN composer install --optimize-autoloader

# Exponer puerto
EXPOSE 8080

# Comando de inicio - SIN CACHE
CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan migrate --seed --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
