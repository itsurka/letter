# Описание проекта

Генератор писем с использованием консольной команды на базе гексагональной архитектуры.

## Запуск команд
Есть 2 use case которые генерируют письма готовые к отправке при помощи консольной команды:
`bin/console letter:generate [-m|--method METHOD]` с возможными `method` "mailing" и "report"

1. `bin/console letter:generate -m report` - генерирует отчет для админа - информация о новых пользователях в системе.
2. `bin/console letter:generate -m mailing` - письмо для каждого пользователя системы с напоминанем о встрече.

## Запуск тестов

`php bin/phpunit tests/UseCasesTest.php`

Результат:

```PHPUnit 8.5.14 by Sebastian Bergmann and contributors.

Testing App\Tests\UseCasesTest
.                                                                   1 / 1 (100%)

Time: 338 ms, Memory: 16.00 MB

OK (1 test, 14 assertions)```