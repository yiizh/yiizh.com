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

RUN chmod +x $APP_PATH/deploy/run && ln -s $APP_PATH/deploy/run /usr/local/bin/run

RUN chmod -R 777 $APP_PATH/src/frontend/runtime \
    $APP_PATH/src/frontend/web/assets \
    $APP_PATH/src/frontend/web/uploads \
    $APP_PATH/src/console/runtime \
    $APP_PATH/modules \

RUN sed -i "s/'YII_DEBUG', true/'YII_DEBUG', false/g" $APP_PATH/src/frontend/web/index.php && \
    sed -i "s/'YII_ENV', 'dev'/'YII_ENV', 'prod'/g" $APP_PATH/src/frontend/web/index.php

RUN sed -i "s/\/var\/www\/html/\/app\/src\/frontend\/web/g"  /etc/apache2/sites-available/000-default.conf

CMD ["run"]