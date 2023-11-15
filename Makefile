# !/usr/bin/make

# Интерпретатор командной строки
SHELL=/bin/bash

# Цель по умолчанию (главная цель)
.DEFAULT_GOAL:=help

# ID текущего пользователя
VAR_CURRENT_USER_ID:=$(shell id -u)
# ID группы текущего пользователя
VAR_CURRENT_USER_GID:=$(shell id -g)

# Директива для указания абстрактной цели
.PHONY: help
# Вывод помощи
help:
	@echo "Скрипты для управления инфраструктурой проекта ${COMPOSE_PROJECT_NAME}"

# ************ # ************ # ************
# Чтение переменных из файлов
# ************ # ************ # ************
include ./.env


# ************ # ************ # ************
# Копирование файлов среды (.env) сервисов бекенда и фронтенда (на основе соответствующих файлов .env.example)
.PHONY: copy_services_envs_from_examples
copy_services_envs_from_examples:
	@echo "Копирование файлов среды (.env) инфраструктуры, сервисов бекенда и фронтенда (на основе соответствующих файлов .env.example)..."
	@echo "..."
	cp ./services/backend/src/.env.example ./services/backend/src/.env # бекенд
	cp ./services/frontend/src/.env.example ./services/frontend/src/.env # фронтенд


# ************ # ************ # ************
# Сборка образа NodeJS
.PHONY: node_js_build_image
node_js_build_image:
	@echo "Сборка образа NodeJS..."
	@echo "..."
	docker build -t ${COMPOSE_PROJECT_NAME}_node_js_image services/node

# ************ # ************ # ************
# Команды, выполняемые из образа NodeJS. Установка зависимостей (node modules) для фронтенда
.PHONY: node_js_frontend_install
node_js_frontend_install:
	@echo "Установка зависимостей (node modules) для фронтенда..."
	@echo "Запуск команды NodeJS от имени текущего пользователя ${USER}"
	@echo "..."
	docker run --rm --volume="./services/frontend/src":/app -u ${VAR_CURRENT_USER_ID}:${VAR_CURRENT_USER_GID} ${COMPOSE_PROJECT_NAME}_node_js_image yarn install

# ************ # ************ # ************
# Команды, выполняемые из образа NodeJS. Сборка фронтенда
.PHONY: node_js_frontend_build
node_js_frontend_build:
	@echo "Сборка фронтенда..."
	@echo "Запуск команды NodeJS от имени текущего пользователя ${USER}"
	@echo "..."
	docker run --rm --volume="./services/frontend/src":/app -u ${VAR_CURRENT_USER_ID}:${VAR_CURRENT_USER_GID} ${COMPOSE_PROJECT_NAME}_node_js_image quasar build


# ************ # ************ # ************
# Сборка и запуск контейнеров
.PHONY: deploy_up
deploy_up:
	@echo "Сборка и запуск контейнеров..."
	@echo "..."
	docker-compose -f docker-compose.yml up -d

# ************ # ************ # ************
# Сборка и запуск контейнеров (docker compose v2)
.PHONY: dc2_deploy_up
dc2_deploy_up:
	@echo "Сборка и запуск контейнеров (docker compose v2)..."
	@echo "..."
	docker compose -f docker-compose.yml up -d


# ************ # ************ # ************
# Сборка и запуск контейнеров с пересборкой образов
.PHONY: deploy_up_rebuild
deploy_up_rebuild:
	@echo "Сборка и запуск контейнеров с пересборкой образов..."
	@echo "..."
	docker-compose -f docker-compose.yml up -d --build


# ************ # ************ # ************
# Сборка и запуск контейнеров с пересборкой образов (docker compose v2)
.PHONY: dc2_deploy_up_rebuild
dc2_deploy_up_rebuild:
	@echo "Сборка и запуск контейнеров с пересборкой образов (docker compose v2)..."
	@echo "..."
	docker compose -f docker-compose.yml up -d --build


# ************ # ************ # ************
# Остановка и удаление контейнеров
.PHONY: deploy_down
deploy_down:
	@echo "Остановка и удаление контейнеров..."
	@echo "..."
	docker-compose -f docker-compose.yml down


# ************ # ************ # ************
# Остановка и удаление контейнеров (docker compose v2)
.PHONY: dc2_deploy_down
dc2_deploy_down:
	@echo "Остановка и удаление контейнеров (docker compose v2)..."
	@echo "..."
	docker compose -f docker-compose.yml down


# ************ # ************ # ************
# Команды, выполняемые из контейнера бекенда от имени текущего пользователя. Установка зависимостей для бекенда.
.PHONY: backend_install_composer
backend_install_composer:
	@echo "Установка зависимостей (composer modules) для бекенда..."
	@echo "..."
	.bin/docker_exec_current_user.sh --docker_container_name=${COMPOSE_PROJECT_NAME}_backend_api --docker_container_command='composer install'


# ************ # ************ # ************
# Команды, выполняемые из контейнера бекенда от имени текущего пользователя. Запуск миграций базы данных.
.PHONY: backend_migrate
backend_migrate:
	@echo "Запуск миграций базы данных..."
	@echo "..."
	.bin/docker_exec_current_user.sh --docker_container_name=${COMPOSE_PROJECT_NAME}_backend_api --docker_container_command='php artisan migrate'

# ************ # ************ # ************
# Команды, выполняемые из контейнера бекенда от имени текущего пользователя. Генерация ключа приложения
.PHONY: backend_app_key_generate
backend_app_key_generate:
	@echo "Генерация ключа приложения..."
	@echo "..."
	.bin/docker_exec_current_user.sh --docker_container_name=${COMPOSE_PROJECT_NAME}_backend_api --docker_container_command='php artisan key:generate'

# ************ # ************ # ************
# Установка прав доступа к директориям (кеш, логи)
.PHONY: backend_chmod_dirs
backend_chmod_dirs:
	@echo "Установка прав доступа к директориям (кеш, логи)..."
	@echo "..."
	chmod 777 ./services/backend/src/storage/framework/cache/data
	chmod 777 ./services/backend/src/storage/framework/sessions
	chmod 777 ./services/backend/src/storage/framework/views
	chmod 777 ./services/backend/src/storage/logs

# ************ # ************ # ************
# Вывод текста перед операцией "Быстрая установка и развёртывание"
.PHONY: quick_install_and_deploy_echo
quick_install_and_deploy_echo:
	@echo "Быстрая установка и развёртывание..."
	@echo "..."

# ************ # ************ # ************
# Быстрая установка и развёртывание
# ************ # ************ # ************
.PHONY: quick_install_and_deploy
quick_install_and_deploy: quick_install_and_deploy_echo copy_services_envs_from_examples node_js_build_image node_js_frontend_install node_js_frontend_build deploy_up backend_install_composer backend_app_key_generate backend_migrate

# ************ # ************ # ************
# Быстрая установка и развёртывание (docker compose v2)
# ************ # ************ # ************
.PHONY: dc2_quick_install_and_deploy
dc2_quick_install_and_deploy: quick_install_and_deploy_echo copy_services_envs_from_examples node_js_build_image node_js_frontend_install node_js_frontend_build dc2_deploy_up backend_install_composer backend_app_key_generate backend_migrate
