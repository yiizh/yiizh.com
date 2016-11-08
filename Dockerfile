FROM yiizh/php7

MAINTAINER Di Zhang <zhangdi_me@163.com>

ARG APP_ENV
ARG MYSQL_HOST
ARG MYSQL_DB
ARG MYSQL_USER
ARG MYSQL_PASS

ENV APP_PATH=/app

VOLUME ["/opt/composer/cache"]

WORKDIR $APP_PATH

COPY . $APP_PATH

RUN chmod -R 777 $APP_PATH/src/frontend/runtime \
    $APP_PATH/src/frontend/web/assets \
    $APP_PATH/src/frontend/web/uploads \
    $APP_PATH/src/console/runtime \
    $APP_PATH/src/frontend/web/sitemaps

RUN cd $APP_PATH && \
    composer config -g cache-dir /opt/composer/cache && \
    composer config -g repo.packagist composer https://packagist.phpcomposer.com && \
    composer config -g github-oauth.github.com 4b3b4c18ac03400f34db8736524b34b31677fc4c && \
    composer global require "fxp/composer-asset-plugin:~1.2.0" && \
    composer install -vvv --prefer-dist --no-dev --optimize-autoloader

RUN rm -rf $APP_PATH/env.ini && rm -rf /var/www/html && ln -s $APP_PATH/src/frontend/web /var/www/html