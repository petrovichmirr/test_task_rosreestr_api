## Rosreestr Api Test

## Установка

### Подготовка инфраструктуры

Клонируем репозиторий:
```bash
git clone https://github.com/petrovichmirr/test_task_rosreestr_api.git rosreestr_api
```

Переходим в корневую папку инфраструктуры и создаём в ней файл с переменными окружения `.env` (на основе имеющегося файла `.env.example`):
```bash
cd rosreestr_api
cp .env.example .env
```

### Быстрая установка

Выполните из терминала, находясь в корневой папке инфраструктуры.
Выполняем команду быстрого развёртывания. Для docker-compose версии 1:
```bash
make quick_install_and_deploy
```
Для docker-compose версии 2:
```bash
make dc2_quick_install_and_deploy
```

Выполним проверку, выведем список контейнеров `docker`:
```bash
docker ps
```

### Всё готово, проверяем:

Фронтенд:

[http://localhost:30001](http://localhost:30001)

Статус API бекенда:

[http://localhost:30002/api/v1/test](http://localhost:30002/api/v1/test)


## Удаление

Остановка и удаление контейнеров...