# Simple News
### Описание
Данный репозиторий реализует основные API CRUD новостей:
1. JWT Авторизация / Регистрация
2. Создание, Редактирование, Удаление новости (только авторизованные пользователи, редактирование/удаление - только своих новостей)
3. Просмотр всех новостей

### Требования
- Docker
- Make (не обязательно)

### Локальное развертывание
Для локального развертывания необходимо склонировать репозиторий:

    git clone https://github.com/QDenka/simple-news.git
1. Запустить Docker
2. Скопировать .env.example в .env
3. Если есть Make:
   3.1. Запустить команду `make init`
4. Если нет Make:

        docker compose build
        docker compose up -d
        docker compose exec app composer install  
    	docker compose exec app php artisan key:generate  
    	docker compose exec app php artisan storage:link  
    	docker compose exec app php artisan jwt:secret  
    	docker compose exec app chmod -R 777 storage bootstrap/cache
    	docker compose exec app php artisan migrate:fresh
    	docker compose exec app php artisan db:seed

### Роутинги
Ссылка на коллекцию Postman: https://api.postman.com/collections/14768469-f46407fc-eee2-4e98-822d-35cab64dd820?access_key=PMAT-01GZ616CZ8AMRM267S40BN5Q2G

| Название    | Метод  | Роут          | Обязательные параметры      |
|-------------|--------|---------------|----------------|
| Get News    | GET    | /api/news     | -              |
| Create News | POST   | /api/news     | title, content, category_ids[]           |
| Update News | PUT    | /api/news/{news_id} | title, content, category_ids[]       |
| Delete News | DELETE | /api/news/{news_id} | -       |
| Login       | POST   | /login        | email, password              |
| Logout      | GET    | /logout       | -             |
| Register    | POST   | /register     | name, email, password, password_confirmation              |

### Описание
При инициализации приложения локально, база будет забита моковыми данными.
Для каждого из методов контроллера написаны базовые тесты.
Для запуска тестов:

    docker compose exec app php artisan test

### Структура
    ├── Console
    │   ├── Commands                   # Кастомные команды Artisan
    ├── DataTransferObjects           # Объекты для передачи данных между слоями приложения
    ├── Exceptions                    # Кастомные исключения
    │   ├── Handler.php               # Обработчик исключений
    ├── Http
    │   ├── Controllers               # Контроллеры для обработки HTTP запросов
    │   ├── Middleware                # Middleware для обработки HTTP запросов перед и после выполнения запроса
    │   ├── Requests                  # Формы запросов и валидация данных
    ├── Models                        # Модели Eloquent ORM для работы с базой данных
    ├── Providers                     # Сервис провайдеры для определения сервисов и регистрации зависимостей
    ├── Repositories                  # Репозитории для доступа к данным в базе данных и реализации паттерна Repository
    ├── Services                      # Сервисы для обработки бизнес-логики и взаимодействия с другими слоями
    └── Traits                        # Трейты для общих функциональных возможностей, которые могут быть переиспользованы
