#!/usr/bin/env bash

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

info "Provision-script user: `whoami`"

info "Install composer packages"
composer config -g repo.packagist composer https://packagist.phpcomposer.com && \
composer config -g github-oauth.github.com 4b3b4c18ac03400f34db8736524b34b31677fc4c && \
composer global require "fxp/composer-asset-plugin:~1.2.0" && \
cd /vagrant && composer install -vvv --prefer-dist
echo "Done!"

info "Init application"
php /vagrant/bin/console migrate --interactive=0 && \
php /vagrant/bin/console migrate --interactive=0 --migrationPath=@yii/rbac/migrations && \
php /vagrant/bin/console migrate --interactive=0 --migrationPath=@yii/caching/migrations