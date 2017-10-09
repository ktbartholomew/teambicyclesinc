FROM wordpress:4.8.2-php7.1-apache

RUN apt-get update && \
  apt-get install -y libzip-dev && \
  docker-php-ext-install zip && \
  rm -rf /var/lib/apt/lists/*

COPY dist/ /var/www/html/wp-content/themes/theme/
COPY wp-config.php /var/www/html/wp-config.php
