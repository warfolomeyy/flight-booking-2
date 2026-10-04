# API сервиса бронирования и заказа авиабилетов

Бэкенд-приложение, разработанное в рамках тестового задания. Реализует REST API для системы регистрации, аутентификации, управления корзиной, оформления заказов, а также защищенную административную панель для управления авиабилетами.

## Технологии
- PHP / Laravel
- PostgreSQL (реляционная база данных)
- pgAdmin (веб-интерфейс для управления базой данных)
- Docker & Docker Compose (контейнеризация среды)

## Структура проекта
- `deploy/` - файлы конфигурации Docker и docker-compose.
- `project/` - исходный код бэкенд-приложения на Laravel.
- `collection/` - экспортированная коллекция Postman со всеми эндпоинтами и документацией.

---

## Инструкция по запуску проекта

### 1. Клонирование репозитория
Клонируйте репозиторий на ваш локальный компьютер и перейдите в корень проекта:

```bash
git clone <https://github.com/warfolomeyy/flight-booking-2>
cd flight-booking-2

```

### 2. Запуск контейнеров Docker
Перейдите в папку с конфигурацией Docker и запустите контейнеры:

```bash
cd deploy
docker-compose up -d

```

### 3. Настройка окружения и зависимостей
Перейдите в папку с проектом (`project`), войдите в контейнер приложения, установите зависимости и настройте конфигурацию:

```bash

cd ../project
docker-compose -f ../deploy/docker-compose.yml exec app bash
composer install
cp .env.example .env
php artisan key:generate
```
Откройте файл .env и убедитесь, что параметры подключения к базе данных настроены следующим образом (для корректной работы с Docker Compose):
```env
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=flight_booking
DB_USERNAME=postgres
DB_PASSWORD=pass

```

### 4. Миграции и заполнение базы данных
Выполните миграции и сидеры базы данных, затем выйдите из контейнера:

```bash
php artisan migrate --seed
exit

```

---

## Тестовые учетные записи 

**Администратор**
- E-mail: admin@flight.ru
- Пароль: QWEasd123

**Клиент**
- E-mail: user@flight.ru
- Пароль: password


## Тестирование API
Импортируйте коллекцию Postman из файла collection/Flight Booking API.postman_collection.json в ваш Postman для тестирования всех эндпоинтов.
