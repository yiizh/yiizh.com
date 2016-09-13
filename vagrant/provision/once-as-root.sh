#!/usr/bin/env bash

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}


info "Provision-script user: `whoami`"

info "Configure Apache"
a2enmod rewrite
sed -i 's/APACHE_RUN_USER=www-data/APACHE_RUN_USER=vagrant/g' /etc/apache2/envvars
sed -i 's/APACHE_RUN_GROUP=www-data/APACHE_RUN_GROUP=vagrant/g' /etc/apache2/envvars

info "Enabling site configuration"
ln -s /apps/vagrant/apache/apps.conf /etc/apache2/sites-enabled/apps.conf

info "Install Composer Vendor"
composer config -g repo.packagist composer https://packagist.phpcomposer.com
composer config -g github-oauth.github.com 4b9576f0957903fa12044b7fb1bedf3b73fecdfc
composer global require "fxp/composer-asset-plugin:~1.1.1"
cd /apps && composer install -vvv --prefer-dist

info "Create Database on VM first run"
mysql -uroot -proot -e "create database if not exists yiizh default charset utf8 collate utf8_unicode_ci;"

info "Apply database migrations."
php /apps/bin/console migrate --interactive=0 --migrationPath=@yii/rbac/migrations
php /apps/bin/console migrate --interactive=0
echo "Done!"