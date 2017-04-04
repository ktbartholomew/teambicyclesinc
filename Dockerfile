FROM quay.io/ktbartholomew/wordpress-php-mods

COPY dist/ /var/www/html/wp-content/themes/theme/
COPY wp-config.php /var/www/html/wp-config.php
