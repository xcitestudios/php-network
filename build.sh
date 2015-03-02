#!/bin/bash

git clone https://github.com/xcitestudios/php-network.git
cd php-network
composer install
phing docs
rm -rf ../docs
mv docs ../
cd ../
rm -rf php-network
