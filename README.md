# Необходимо реализовать сервис получения курса по конкретной валюте.


Курс берем с API банка - https://api.privatbank.ua/#p24/exchange Для
работы с API используем Guzzle.
- Создаем миграцию для таблицы currencies (id, currency, buy, sell).
**CreateCurrenciesTable**
- Создаем миграцию для таблицы users (id, token, expired_at).
**CreateUsersTable**
- Используя планировщик задач Laravel создать задачу в виде команды для
обновления данных по курсу и записи в БД.
**App\Console\Commands\UpdatedCurrencies, command('currencies:update')**
## Реализовать REST API:
- GET - /currencies — должен возвращать список курсов валют с
возможность пагинации;
- GET - /currency/{code} — должен возвращать курс для переданного
currency (UAH, USD);
- POST - /currency (Создание новой записи в БД). Провести валидацию в
Request, валидировать currency (UAH, USD), значения и проверка на
уникальность currency (UAH, USD);
- PUT - /currency/{code} (Изменение записи в БД) (UAH, USD) Метод для
изменения полей buy и sell. Также должная быть валидация значений
курса в Request;
- DELETE - /currency/{code} (UAH, USD) Метод для удаления записей с БД;

**CurrencyController, 
Requests: StoreCurrency, UpdateCurrency
views: home, components/**

## API должно быть закрыто bearer авторизацией. 
Проверка должна проводится в middleware. Дополнительно у пользователя есть дата
истечения токена (expired_at), необходимо проверить активен ли токен.
Система токенов может быть создана своя или же использована
дефолтная от Laravel.
**Закрыл обычной авторизацией с паролем. С bearer раньше не работал, по ходу пытался 
использовать, но все поломал :(**


## Необходимо реализовать историю курсов валют.
- При обновлении курса по крону или методу API необходимо сохранять предыдущие 
значения курсов в отдельной таблице.
**Model\Currency::boot()**
- Добавить метод API: GET - /history Должен вернуть JSON объект каждой валюты и 
внутри каждой из них история ее изменений. Использовать relation hasMany.
**CurrencyController->history()**


## Запуск:
- composer install
- .env
- php artisan migrate
- авторизоваться для возможности создавать и изменять валюты
