
FROM php:8.3-fpm

ARG user
ARG uid


# Install system dependencies
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git curl unzip

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd pdo pdo_mysql

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -u $uid -ms /bin/bash -g www-data $user

# Set working directory
WORKDIR /var/www

# Copy existing application directory
COPY ../.. .

COPY --chown=$user:www-data ../../.. /var/www

USER $user

# Install Laravel dependencies
RUN composer install

CMD ["php-fpm"]

EXPOSE 9000
