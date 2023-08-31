FROM php:8.2-apache

# Install system dependencies
RUN apt update && apt install -y \
    git \
    curl \
    libcurl4-openssl-dev \
    openssl \
    zlib1g-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsodium-dev \
    zip \
    unzip \
    software-properties-common

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo mysqli
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install mbstring && docker-php-ext-enable mbstring 
RUN docker-php-ext-install dom && docker-php-ext-enable dom 
RUN docker-php-ext-install opcache && docker-php-ext-enable opcache 
RUN docker-php-ext-install xml && docker-php-ext-enable xml
RUN docker-php-ext-install simplexml && docker-php-ext-enable simplexml
RUN docker-php-ext-install sodium && docker-php-ext-enable sodium
RUN docker-php-ext-install soap && docker-php-ext-enable soap
RUN docker-php-ext-install gd && docker-php-ext-enable gd
RUN docker-php-ext-install curl && docker-php-ext-enable curl

# Get latest Composer
# Allow Composer to be run as root
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php --  --install-dir=/usr/bin --filename=composer

COPY cert.pem /etc/apache2/ssl/cert.pem
COPY cert-key.pem /etc/apache2/ssl/cert-key.pem
RUN mkdir -p /var/run/apache2/

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN ln -s /etc/apache2/mods-available/ssl.load  /etc/apache2/mods-enabled/ssl.load

RUN a2enmod rewrite env ssl \
    && a2ensite 000-default.conf \
    && service apache2 restart

EXPOSE 80
EXPOSE 443

ADD foreground.sh /etc/apache2/foreground.sh

#CMD . /bin/bash novo-cliente-development.sh