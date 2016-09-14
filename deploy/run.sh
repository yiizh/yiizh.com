#!/usr/bin/env bash

set -e

if [ ! -d "$WORKDIR/vendor" ]; then
    cd $WORKDIR && \
    composer config -g repo.packagist composer https://packagist.phpcomposer.com && \
    composer global require "fxp/composer-asset-plugin:~1.1.1" && \
    composer install -vvv --prefer-dist --no-dev --optimize-autoloader
fi

source /etc/apache2/envvars && exec /usr/sbin/apache2 -DFOREGROUND