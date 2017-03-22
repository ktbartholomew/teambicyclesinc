#!/bin/bash

set -ueo pipefail

scriptroot="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

if [ ! -d ${scriptroot}/../dist ];then
  mkdir -p ${scriptroot}/../dist
  mkdir -p ${scriptroot}/../dist/img
  mkdir -p ${scriptroot}/../dist/templates
fi

if [ ! -d ${scriptroot}/../src/vendor ];then
  docker run --rm \
  -v ${scriptroot}/../src:/app composer install -o
fi

cp -a ${scriptroot}/../src/ ${scriptroot}/../dist/
