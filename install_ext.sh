#!/bin/bash
#This script is to install PHP extensions
 
 
 
 
#The environment variable

php_list=$(whereis php)
echo -e "查找到您的所有php目录$php_list,\n请输入你的php根目录:"

read PHP_HOME

cd install_data/php-beast-master
$PHP_HOME/bin/phpize
./configure --with-php-config=$PHP_HOME/bin/php-config

#compile
make
#install
make install
#php.ini file insert the extension=beast.so
if grep -Fxq "extension=beast.so" $PHP_HOME/etc/php.ini
 then
    echo "extension=beast.so exist "
 else
    echo -e "\n[mysql]\nextension=beast.so" >> $PHP_HOME/etc/php.ini
fi

echo "扩展安装完毕,请重启php"
