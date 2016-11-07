#!/bin/bash

# Docker dependencies
[[ ! -e /.dockerenv ]] && [[ ! -e /.dockerinit ]] && exit 0

set -xe

# Install Git
apt-get update -yqq
apt-get install git -yqq

# Install phpunit
curl --location --output /usr/local/bin/phpunit https://phar.phpunit.de/phpunit.phar
chmod +x /usr/local/bin/phpunit

# Install PostgreSQL driver
docker-php-ext-install pdo_pgsql