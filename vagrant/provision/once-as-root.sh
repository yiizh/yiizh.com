#!/usr/bin/env bash

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}


info "Provision-script user: `whoami`"

info "Create MySQL Database."
mysql -uroot -proot -e "create database if not exists yiizh default charset utf8 collate utf8_unicode_ci";
echo "Done!"

info "Configure Apache"
a2enmod rewrite
sed -i 's/APACHE_RUN_USER=www-data/APACHE_RUN_USER=vagrant/g' /etc/apache2/envvars
sed -i 's/APACHE_RUN_GROUP=www-data/APACHE_RUN_GROUP=vagrant/g' /etc/apache2/envvars
ln -s /code/vagrant/apache/apps.conf /etc/apache2/sites-enabled/apps.conf
echo "Done!"

info "Install composer packages"
sudo su vagrant && composer config -g repo.packagist composer https://packagist.phpcomposer.com && \
composer config -g github-oauth.github.com 4b3b4c18ac03400f34db8736524b34b31677fc4c && \
composer global require "fxp/composer-asset-plugin:~1.2.0" && \
cd /code && composer install -vvv --prefer-dist
echo "Done!"

info "Init application"
php /code/bin/console migrate --interactive=0 && \
php /code/bin/console migrate --interactive=0 --migrationPath=@yii/rbac/migrations