FROM wordpress:4.7.3-php7.1-apache

RUN apt-get update && \
  apt-get install -y libzip-dev && \
  docker-php-ext-install zip

COPY dist/ /var/www/html/wp-content/themes/theme/
COPY test/wp-config.php /var/www/html/wp-config.php
