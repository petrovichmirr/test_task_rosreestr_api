FROM php:8.1.12-cli
#
# Образ для запуска планировщиком cron скриптов php-cli
#

# Установка дополнительных расширений PHP
# !!! TODO: рефакторинг - использовать один образ для web/cron, чтобы не повторять строку с расширениями
# Расширения для web/cron должны быть одинаковыми!!!
# см. https://github.com/mlocati/docker-php-extension-installer
#
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions @composer bcmath pdo_mysql pdo_pgsql pgsql bz2 mysqli pcntl redis xdebug zip

# Рабочая директория
WORKDIR /usr/src/app

# Установка cron
RUN apt-get update && apt-get install -y cron

# Копируем задания с хоста
RUN mkdir -p /usr/src/cron
COPY cron_jobs /usr/src/cron/jobs

# Включаем задания
RUN crontab /usr/src/cron/jobs

# Запуск cron
CMD [ "cron", "-f" ]
