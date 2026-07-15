FROM wordpress:php8.2-apache

RUN apt-get update \
    && apt-get install -y libxml2-dev \
    && docker-php-ext-install soap \
    && docker-php-ext-enable soap \
    && rm -rf /var/lib/apt/lists/*