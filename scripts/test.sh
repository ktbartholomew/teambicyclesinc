#!/bin/bash

set -ueo pipefail

scriptroot="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"


usage() {
  echo "usage: test.sh [up|down]"
  exit 1
}

up() {
  docker stack up -c ${scriptroot}/../docker-compose.yml teambicyclesinc
}

down() {
  docker stack rm teambicyclesinc
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
