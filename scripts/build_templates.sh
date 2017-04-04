#!/bin/bash

set -ueo pipefail

scriptroot="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

set +e
php_errors=0
for file in $(find ./src -type f -name '*.php' -not -path "./src/vendor/*"); do
  output=$(php -l $file)
  if [ "$?" != "0" ]; then
    php_errors=1
    echo "$output"
  fi
done
set -e

if [ "$php_errors" == "1" ]; then
  exit 1;
fi

if [ ! -d ${scriptroot}/../dist ];then
  mkdir -p ${scriptroot}/../dist
  mkdir -p ${scriptroot}/../dist/img
  mkdir -p ${scriptroot}/../dist/templates
fi

# This stanza expects to run in the composer docker container
if [ ! -d ${scriptroot}/../src/vendor ];then
  pushd src
  composer install -o
  popd
fi

cp -a ${scriptroot}/../src/* ${scriptroot}/../dist/
