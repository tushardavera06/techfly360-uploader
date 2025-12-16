FROM php:8.2-cli

# System dependencies + ZIP extension
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    libzip-dev \
 && docker-php-ext-install zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# App directory
WORKDIR /app

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Render port
EXPOSE 10000

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:10000"]