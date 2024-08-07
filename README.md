Задание:

  Реализовать методы REST API для работы с пользователями: Создание
  пользователя; Обновление информации пользователя; Удаление
  пользователя; Авторизация пользователя; Получить информацию о
  пользователе.

Создание пользователя:

  `/api/create-user.php` - создание пользователя по полям с фронтенда `name`, `email`, `password`.
  `password` - хешируется (MD5) для сохранности паролей перед записью в БД.

Обновление информации пользователя:

  `/api/update-user.php` - обновление пользователя по полям с фронтенда `name`, `email`, `password`.
  ```jsx
  $_GET['id']
```
 - так мы узнаем `id` пользователя, какого именно редактируем.

Удаление пользователя:

  `/api/delete-user.php` - удаление пользователя по  `id`.
  ```jsx $_GET['id']``` - так мы узнаем `id` пользователя.

Авторизация пользователя:

  `/api/auth-user.php` - Проверяем есть ли такой вообще пользователь, предварительно хешируем пароль, для сравнения с тем что в БД
  ```jsx
 $statement = $PDO->prepare(
            'SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1'
        );
        $statement->execute([
            'email' => $email,
            'password' => md5($password)
        ]);
```

Получить информацию о пользователе: 

  `/api/get-segment-user.php` - получение пользователя по  `id`.

  ```jsx
  $_GET['id']
```
 - так мы узнаем `id` пользователя, какого именно хотим получить.
