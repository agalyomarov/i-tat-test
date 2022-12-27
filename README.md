# i-tat-test

1. composer install
2. php artisan storage:link
3. php artisan migrate:rollback
4. Импортировать test_rest_api.postman_collection.json в postman

Список методов

-   post /api/register = регистрация
-   post /api/login = авторизация
-   get /api/category = получить все категории
-   post /api/category = с id на редактирование, без добавление категории
-   post /api/category/delete = удаление категории
-   get /api/diches = получить все блюди
-   post /api/diches= с id на редактирование, без добавление блюди
-   post /api/category/delete = удаление блюди
-   get api/report = получение отчеты
