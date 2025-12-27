# To-Do List API

![PHP](https://img.shields.io/badge/PHP-8.4%2B-777BB4?logo=php)
![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel)
![Docker](https://img.shields.io/badge/Docker-Sail-2496ED?logo=docker)

REST API приложение для управления списком задач, разработанное в рамках тестового задания на позицию Junior PHP Developer.

## Описание

Проект представляет собой бэкенд-часть (API) для приложения "Список задач". Реализован полный цикл CRUD-операций, валидация входящих данных и корректная обработка HTTP-статусов.

Приложение работает в Docker-окружении с использованием Laravel Sail

##  Технический стек

* **Фреймворк:** Laravel 12
* **Язык:** PHP 8.4
* **База данных:** MySQL
* **Окружение:** Docker (Laravel Sail)

##  Установка и запуск

Для запуска проекта необходимо наличие установленных **Docker** и **Docker Compose**.

1. **Клонируйте репозиторий:**
   ```bash
   git clone https://github.com/miskovp/todo-api.git
   cd todo-api
   ```

2. **Настройте переменные окружения:**
   Скопируйте пример файла конфигурации:
   ```bash
   cp .env.example .env
   ```
   *Настройки подключения к БД в `.env` уже сконфигурированы для работы с Laravel Sail по умолчанию.*

3. **Установите зависимости (выберите один вариант):**

    **Вариант А (Если у вас установлен PHP и Composer локально):**
    ```bash
    composer install
    ```

    **Вариант Б (Если только Docker): Используйте временный контейнер для установки зависимостей:**
   ```bash
   docker run --rm \
       -u "$(id -u):$(id -g)" \
       -v "$(pwd):/var/www/html" \
       -w /var/www/html \
       laravelsail/php84-composer:latest \
       composer install --ignore-platform-reqs
   ```

4. **Запустите проект:**
   ```bash
   ./vendor/bin/sail up -d
   ```

5. **Инициализация приложения: Сгенерируйте ключ приложения и запустите миграции:**
   ```bash
   ./vendor/bin/sail artisan key:generate
   ./vendor/bin/sail artisan migrate
   ```

Приложение будет доступно по адресу: `http://localhost`

## API Документация

Базовый URL: `http://localhost/api`

### Сущность Task (Задача)

Структура объекта:
```json
{
  "id": 1,
  "title": "Test title",
  "description": "Test Description",
  "status": "pending",
  "created_at": "2025-12-24T12:00:00.000000Z",
  "updated_at": "2025-12-24T12:00:00.000000Z"
}
```

*Примечание: Поле `status` может принимать значения `pending` или `completed`.*

### Эндпоинты

| Метод  | URL          | Описание                  | Тело запроса (Body) |
| :---   | :---         | :---                      | :--- |
| `GET`  | `/tasks`     | Получить список всех задач| - |
| `POST` | `/tasks`     | Создать новую задачу      | `{"title": "...", "description": "...", "status": "pending"}` |
| `GET`  | `/tasks/{id}`| Получить задачу по ID     | - |
| `PUT`  | `/tasks/{id}`| Обновить задачу           | `{"title": "...", "status": "completed"}` |
| `DELETE`| `/tasks/{id}`| Удалить задачу            | - |
