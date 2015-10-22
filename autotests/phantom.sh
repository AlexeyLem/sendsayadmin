#!/bin/bash
phantomjs --webdriver=4444 --ignore-ssl-errors=yes >/dev/null &
sleep 3
php codecept.phar clean
LOGIN=$1 PASS=$2 MailPass=$3 php codecept.phar run acceptance --xml $4
killall -9 phantomjs