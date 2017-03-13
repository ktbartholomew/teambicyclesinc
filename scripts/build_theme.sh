#!/bin/bash

set -ueo pipefail

scriptroot="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

if [ ! -d ${scriptroot}/../dist ];then
  mkdir -p ${scriptroot}/../dist
fi

if [ ! -d ${scriptroot}/../src/vendor ];then
  docker run --rm \
  -v ${scriptroot}/../src:/app composer install
fi

cp -a ${scriptroot}/../src/ ${scriptroot}/../dist/
