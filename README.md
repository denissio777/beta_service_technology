## Доброго времени суток! Keep calm and drink coffee :) Have a nice day!

Для работы данного севиса, вам необходимо вначале создать базу данных и настроить её конфигурацию в файлах db.php и the_best_db.php, также необходимо установить cors-anywhere.Сделать это вы можете с помощью команды npm install,
т.к. необходимые записи конфигурации присутствуют в файле package-lock.json .Далее вам необходимо запустить cors-anywhere.
Сделать вы можете следующим образом: перейдите в папку модуля с помощью терминала и запустите модуль с помощью команды 'node server.js',
перед этим убедитесь,что адрес вашего локального хоста в server.js указан верно,и порт не конфликтует с вашими текущими запущенными процессами.
Далее просто наслаждайтесь сервисом :) Благодарю за внимание.

Контакты для связи: +380977711778 denissio_developer@ukr.net



Часть 1

Используя открытые методы (XML_daily и XML_dynamic) Центробанка РФ (http://www.cbr.ru/development/SXML/) создать и заполнить Базу Данных.

БД заполняем данными минимум за 30 дней начиная с текущего дня.


В БД должна быть таблица currency c обязательными колонками:

valuteID - идентификатор валюты, который возвращает метод (пример: R01010)

numCode -  числовой код валюты (пример: 036)

сharCode - буквенный код валюты (пример: AUD)

name - имя валюты (пример: Австралийский доллар)

value - значение курса (пример: 43,9538)

date - дата публикации курса (может быть в UNIX-формате или ISO 8601)


Часть 2


2.1.  Реализовать REST API метод, который вернет курс(ы) валюты для переданного valueID за указанный период date (from&to) используя данные из таблицы currency. Параметры передаем методом GET.


2.2. Реализовать веб страницу, на которой размещается таблица со списком валют и данными по этим валютам за указанную в поле/селекторе дату.


Оформление страницы не имеет значения, но любая попытка стилизации (в том числе с использованием фреймворков) будет плюсом для соискателя.