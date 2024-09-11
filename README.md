# Тестирование API

## Примеры запросов

### Получение списка гостей

**Эндпоинт:** `GET /api/guests`
**Описание:** Получение списка всех гостей. ### Создание нового гостя
**Тело ответа:** ```json [
  {
    "id": 2,
    "first_name": "Иван",
    "last_name": "Иванов",
    "email": "ivanov@example.com",
    "phone": "+71234567890",
    "country": "Россия",
    "created_at": "2024-09-09T18:27:04.000000Z",
    "updated_at": "2024-09-09T18:27:04.000000Z"
  }
] ```

### Создание нового гостя

**Эндпоинт:** `POST /api/guests`
**Описание:** Создание нового гостя.
**Тело запроса:** `json { "first_name": "Иван", "last_name": "Иванов", "email": "ivanov@example.com", "phone": "+71234567890" } `

**Тело ответа:** `json [
  {
    "id": 2,
    "first_name": "Иван",
    "last_name": "Иванов",
    "email": "ivanov@example.com",
    "phone": "+71234567890",
    "country": "Россия",
    "created_at": "2024-09-09T18:27:04.000000Z",
    "updated_at": "2024-09-09T18:27:04.000000Z"
  }
] `

### Просмотр информации о конкретном госте

**Эндпоинт:** `GET /api/guests/{id}`
**Описание:** Получение информации о конкретном госте по его ID. ### Обновление информации о госте

### Обновление информации конкретного гостя

**Эндпоинт:** `PUT /api/guests/{id}`
**Описание:** Обновление информации о госте по его ID.
**Тело запроса:** `json { "first_name": "Петр", "phone": "+79876543210" } `
**Тело ответа:** `json
{
"id": 2,
"first_name": "Ива555",
"last_name": "Иванов",
"email": "ivanov@example.com",
"phone": "+71234567890",
"country": "Россия",
"created_at": "2024-09-09T18:27:04.000000Z",
"updated_at": "2024-09-09T18:38:51.000000Z"
}`

### Удаление гостя

**Эндпоинт:** `DELETE /api/guests/{id}`
**Описание:** Удаление гостя по его ID.
