#!/bin/bash

set -ueo pipefail

cp -a /usr/src/wordpress/. /var/www/html/

cat > .htaccess <<EOF
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
EOF

mkdir -p /var/www/html/wp-content/plugins
chown -R www-data:www-data /var/www/html || true

acfurl="https://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=${ACF_KEY}"
curl -sSL -o /tmp/acf.zip "$acfurl"
zipok=$(wc -c /tmp/acf.zip | awk '{print $1}')

if [ "$zipok" == "0" ]; then
  echo "The downloaded Advanced Custom Fields plugin file is empty; There may"
  echo "have been a problem with the download. Tried to download from this URL:"
  echo "$acfurl"
  exit 1
fi

unzip -o -q /tmp/acf.zip -d wp-content/plugins
rm /tmp/acf.zip

if [[ "$@" == ""  ]];then
  apache2-foreground
else
  exec "$@"
fi
