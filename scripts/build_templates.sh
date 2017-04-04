#!/bin/bash

set -ueo pipefail

scriptroot="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

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
