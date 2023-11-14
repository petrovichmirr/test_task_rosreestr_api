#!/usr/bin/env bash

# Запуск команды контейнера от имени текущего пользователя
VALID_ARGS=$(getopt -o p:i:c:h --long dir_path_host:,docker_container_name:,docker_container_command:,help -- "$@")
if [[ $? -ne 0 ]]; then
  exit 1
fi

eval set -- "$VALID_ARGS"
while [ : ]; do
  case "$1" in
  -p | --dir_path_host)
    dir_path_host=${2}
    shift 2
    ;;
  -i | --docker_container_name)
    docker_container_name=${2}
    shift 2
    ;;
  -c | --docker_container_command)
    docker_container_command=${2}
    shift 2
    ;;
  -h | --help)
    echo -e "Запуск команды контейнера от имени текущего пользователя.\nИспользование: $(basename $0) -p|--dir_path_host='Путь к директории на хосте, в которой запускается команда' -i|--docker_container_name='Имя контейнера' -c|--docker_container_command='Команда контейнера, например: composer install' -h|--help - помощь"
    exit 0
    ;;
  --)
    shift
    break
    ;;
  esac
done

echo -e "Запуск команды контейнера от имени текущего пользователя ${USER}"
docker exec -ti -u $(id -u):$(id -g) ${docker_container_name} ${docker_container_command}
