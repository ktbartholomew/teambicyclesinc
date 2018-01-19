#!/bin/bash

set -uxeo pipefail

key=${AWS_KEY}
secret=${AWS_SECRET}

function upload_release() {
  zip -q -r -9 -o /tmp/release.zip /var/www/html

  file=${1}.zip
  aws_path=/teambicyclesinc/releases/
  bucket='ktbartholomew'
  date=$(date +"%a, %d %b %Y %T %z")
  acl="x-amz-acl:public-read"
  content_type='application/zip'
  string="PUT\n\n$content_type\n$date\n$acl\n/$bucket$aws_path$file"
  signature=$(echo -en "${string}" | openssl sha1 -hmac "${secret}" -binary | base64)
  curl -X PUT -T "/tmp/release.zip" \
    -H "Host: $bucket.nyc3.digitaloceanspaces.com" \
    -H "Date: $date" \
    -H "Content-Type: $content_type" \
    -H "$acl" \
    -H "Authorization: AWS ${key}:$signature" \
    "https://$bucket.nyc3.digitaloceanspaces.com$aws_path$file"

  rm /tmp/release.zip
}

upload_release ${RELEASE}

