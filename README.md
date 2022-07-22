## О проекте

Стриминговый сервис для работы с Ant Media Server. Для разработки используется Laravel 9.

## Установка

### Основные команды
1. Склонируйте репозиторий.
2. Запустите терминал и перейдите в папку с склонированным репозиторием.
3. Установите пакеты Composer, командой `composer install`
4. Установите пакеты NPM, командой `npm install`
5. Сбилдите NPM, командой `npm run build`
6. Сгенерируйте ключ приложения, командой `php artisan key:generate`
7. Смигрируйте транзацкии в БД, командой `php artisan migrate`

### Конфиг .env

Создайте файл .env в корне проекта и внесите в него параметры для работы с Ant Media Server (**замение параметры в квадратных скобках на свои**):

ANT_SCHEME=[http]

ANT_SERVER=[0.0.0.0]

ANT_PORT=[5080]

ANT_APPNAME=[YourApp]

## Запуск проекта

После успешной установки (см. предыдущий пункт):

1. Запустите Sail, командой `sail up`, либо используйте стандартный сервер PHP (либо ваше решение).
2. Откройте сайт с проектом и пользуйтесь :)

## Лицензия Laravel

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
