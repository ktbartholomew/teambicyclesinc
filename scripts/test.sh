#!/bin/bash

set -ueo pipefail

scriptroot="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"


usage() {
  echo "usage: test.sh [up|down]"
  exit 1
}

up() {
  if [ "$(docker network ls -q -f name=teambicyclesinc)" == "" ];then
    docker network create teambicyclesinc || true
  fi

  if [ "$(docker ps -q -f name=teambicyclesinc-mysql)" == "" ];then
    docker run -d \
    --net teambicyclesinc \
    --name teambicyclesinc-mysql \
    --env MYSQL_ROOT_PASSWORD=password \
    --env MYSQL_DATABASE=wordpress \
    mysql:5.7
  fi

  if [ "$(docker ps -q -f name=teambicyclesinc-wordpress)" == "" ];then
    docker run -d \
    --net teambicyclesinc \
    --name teambicyclesinc-wordpress \
    -p 8080:80 \
    -v ${scriptroot}/../test/wp-config.php:/var/www/html/wp-config.php \
    -v ${scriptroot}/../dist/:/var/www/html/wp-content/themes/theme \
    wordpress:latest
  fi
}

down() {
  docker rm -f teambicyclesinc-wordpress
  docker rm -f teambicyclesinc-mysql
  docker network rm teambicyclesinc
}

if [ ${1:-""} == "" ]; then
  usage
fi

if [ ${1} != "up" ] && [ ${1} != "down" ]; then
  usage
fi

if [ ${1} == "up" ]; then
  up
  exit 0
fi

if [ ${1} == "down" ]; then
  down
  exit 0
fi
