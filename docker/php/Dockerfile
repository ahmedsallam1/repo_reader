FROM php:7.4-fpm-buster

RUN apt-get update && apt-get install -y \
    gnupg \
    g++ \
    procps \
    openssl \
    git \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg-dev \
    libicu-dev  \
    libonig-dev \
    libxslt1-dev \
    acl \
    && echo 'alias sf="php bin/console"' >> ~/.bashrc

RUN docker-php-ext-configure gd --with-jpeg --with-freetype 

RUN docker-php-ext-install \
    zip xsl gd intl opcache exif mbstring

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/repo_reader

COPY --chown=www-data:www-data composer.json ./
COPY --chown=www-data:www-data composer.lock ./
RUN /usr/local/bin/composer install --no-scripts --no-progress; \
	composer clear-cache

RUN ./vendor/bin/simple-phpunit install

COPY . ./

RUN /usr/local/bin/composer dump-autoload
