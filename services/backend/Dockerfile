FROM php:8.1.12-apache
#
# Образ для web - сервера бекенда php
#

# Установка дополнительных расширений PHP
# !!! TODO: рефакторинг - использовать один образ для web/cron, чтобы не повторять строку с расширениями
# Расширения для web/cron должны быть одинаковыми!!!
# см. https://github.com/mlocati/docker-php-extension-installer
#
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions @composer bcmath pdo_mysql pdo_pgsql pgsql bz2 mysqli pcntl redis xdebug zip

# конфигурация apache

# Подключим модуль rewrite:
RUN a2enmod rewrite

# Копируем файлы кофигурации
COPY docker/apache2/apache2.conf /etc/apache2/apache2.conf
COPY docker/apache2/ports.conf /etc/apache2/ports.conf
COPY docker/apache2/security.conf /etc/apache2/conf-available/security.conf

# Отключаем конфигурацию виртуального хоста по умолчанию
RUN a2dissite 000-default

# Копируем конфигурацию виртуального хоста приложения
COPY docker/apache2/app.conf /etc/apache2/sites-available/app.conf
# Активируем конфигурацию
RUN a2ensite app

# Удаляем директорию html
RUN rm -r /var/www/html

# Рабочая директория
WORKDIR /var/www/app
