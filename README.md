## О проекте

Стриминговый сервис для работы с Ant Media Server. 

Стэк: Laravel 9 + PHP 8.1

## Установка

### Установка зависимостей

1. Склонируйте этот Git-репозиторий к себе.
2. Запустите терминал и перейдите в папку с склонированным репозиторием.
3. Установите пакеты Composer командой `composer install`
4. Установите пакеты NPM командой `npm install`
5. Соберите фронт командой `npm run build`
6. Создайте .env файл командой `echo "APP_KEY=" >> .env`
7. Сгенерируйте ключ приложения командой `php artisan key:generate`
8. Создайте линку для превьюшек командой `php artisan storage:link`

### Конфиг .env

Откройте файл .env в корне проекта и внесите в него параметры для работы с Ant Media Server.

> Это основные параметры, которые нужны для корректной работы сервиса. Если вам потребуются дополнительные параметры, то используйте для этого файл **.env.example**, просто возьмите оттуда все необходимые настройки и пропишите свои данные.

**Замените данные в квадратных скобках на свои:**

ANT_SCHEME=[http]

ANT_SERVER=[127.0.0.1]

ANT_PORT=[5080]

ANT_APPNAME=[LiveApp]

DB_CONNECTION=[mysql]

DB_HOST=[127.0.0.1]

DB_PORT=[3306]

DB_DATABASE=[dbname]

DB_USERNAME=[user]

DB_PASSWORD=[password]

### Миграции БД

После успешной установки зависимостей и настройки .env (см. предыдущие пункты), требуется создать необходимые таблицы и связи в базе данных.

> Для запуска миграций необходимо использовать встроенную команду **artisan migrate**. Я рекомендую использовать для этого Sail, он идёт в комплекте вместе с этим проектом, просто запустите его командой `sail up -d`

Запуск миграций через Sail производится командой `sail artisan migrate` из корневой директории проекта.

## Запуск проекта

Для запуска проекта я рекомендую использовать Sail, он идёт в комплекте вместе с этим проектом, просто запустите его командой `sail up -d`

> В качестве альтернативного варианта вы можете использовать `php artisan serve` или свой локальный LAMP-сервер.

## Лицензия

Это программное обеспечение с открытым исходным кодом, лицензируемое по [MIT](https://opensource.org/licenses/MIT).
