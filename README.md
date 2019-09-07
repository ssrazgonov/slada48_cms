# slada48_cms

## Установка

`git clone https://github.com/ssrazgonov/slada48_cms.git`

----------
переходим в папку slada48_cms, в адресной строке проводника пишем cmd
и выполняем команду

`composer update`

----------

### Из корня запускаем команду
`init`

### Вывод команды init, выбираем что что нам нужно
*Which environment do you want the application to be initialized in?

  [0] Development
  [1] Production

  Your choice [0-1, or "q" to quit] 0*
  
Создаем базу данных, делаем импорт файла slada48.sql

Конфигурируем подключение в файле /common/config/main-local