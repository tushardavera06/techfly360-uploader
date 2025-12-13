FROM php:8.2-cli

# System deps
RUN apt-get update && apt-get install -y unzip git

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# App directory
WORKDIR /app

# Copy project
COPY . .

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Render port
EXPOSE 10000

# Start PHP server
CMD ["php", "-S", "0.0.0.0:10000"]