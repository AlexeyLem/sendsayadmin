#!/bin/bash
#Запуск Selenium server для работы WebDriver
echo -en "\e[1;32mЗапускаем Selenium Server\e[0m\n\r"
nohup java -jar selenium/selenium-server-standalone-2.47.1.jar -Dwebdriver.chrome.driver=selenium/chromedriver >/dev/null &
sleep 10 #Ждем 10 сек запуска сервера
echo -en "\e[1;32mЗапускаем тесты\e[0m\n\r"
#Запуск тестов в Firefox
php codecept.phar clean
LOGIN=$1 PASS=$2 MailPass=$3 php codecept.phar run acceptance --env chrome --xml $4
echo -en "\e[1;32mУбиваем Selenium Server\e[0m\n\r"
wget -q --spider http://localhost:4444/selenium-server/driver/?cmd=shutDownSeleniumServer
