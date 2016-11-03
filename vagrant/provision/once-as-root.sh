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
ln -s /vagrant/vagrant/apache/apps.conf /etc/apache2/sites-enabled/apps.conf
echo "Done!"