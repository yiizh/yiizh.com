FROM yiizh/php7

MAINTAINER Di Zhang <zhangdi_me@163.com>

ARG APP_ENV
ARG MYSQL_HOST
ARG MYSQL_DB
ARG MYSQL_USER
ARG MYSQL_PASS

VOLUME ["/root/.composer"]

COPY . /app
COPY ./deploy/run.sh /run.sh

RUN chmod -R 777 /app/src/frontend/runtime \
    /app/src/frontend/web/assets \
    /app/src/frontend/web/uploads \
    /app/src/console/runtime

RUN sed -i "s/'YII_DEBUG', true/'YII_DEBUG', false/g" /app/src/frontend/web/index.php && \
    sed -i "s/'YII_ENV', 'dev'/'YII_ENV', 'prod'/g" /app/src/frontend/web/index.php

RUN sed -i "s/\/var\/www\/html/\/app\/src\/frontend\/web/g"  /etc/apache2/sites-available/000-default.conf

WORKDIR /app

CMD ['/run.sh']