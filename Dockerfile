FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    libzip-dev \
 && docker-php-ext-install zip

RUN apt-get update && apt-get install -y unzip zip

RUN apt-get update && apt-get install -y zip unzip
RUN docker-php-ext-install zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000", "-t", "/app"]