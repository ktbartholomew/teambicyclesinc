FROM wordpress:4.9.1-php7.0-apache

RUN rm -r /usr/src/wordpress/wp-content/themes/twenty*

RUN apt-get update && \
  apt-get install -y -qqq zip && \
  rm -rf /var/lib/apt/lists/*

COPY php-uploads.ini /usr/local/etc/php/conf.d/
COPY dist/ /var/www/html/wp-content/themes/theme/
COPY wp-config.php /var/www/html/wp-config.php
COPY theme-helper.php /var/www/html/wp-content/mu-plugins/
COPY entrypoint.sh /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
