FROM php:8.1.12-cli
#
# Образ супервизора для запуска скриптов php-cli
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


# Установка supervisor
RUN apt-get update && apt-get install -y supervisor

# Конфигурация supervisor
COPY config/supervisord.conf /etc/supervisor/supervisord.conf

#
# Конфигурации supervisor для различных процессов
# !!! Внимание !!! Закомментируйте не нужные конфигурации !!!
#
# Конфигурация supervisor для процесса Laravel horizon (запуск через консоль artisan)
COPY config/worker_horizon.conf /etc/supervisor/conf.d/worker_horizon.conf
#
# Конфигурация supervisor для процессов очередей (запуск через консоль artisan)
# COPY config/worker_queue_database.conf /etc/supervisor/conf.d/worker_queue_database.conf
# COPY config/worker_queue_redis.conf /etc/supervisor/conf.d/worker_queue_redis.conf
# COPY config/worker_queue_beanstalkd.conf /etc/supervisor/conf.d/worker_queue_beanstalkd.conf
#

ENTRYPOINT ["/usr/bin/supervisord", "--nodaemon", "--configuration",  "/etc/supervisor/supervisord.conf"]
