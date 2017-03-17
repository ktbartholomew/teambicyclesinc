#!/bin/bash

set -ueo pipefail

scriptroot="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

${scriptroot}/build_templates.sh
${scriptroot}/build_css.sh
rm -rf ${scriptroot}/../dist/scss
