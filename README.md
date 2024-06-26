## API бронирования мест на мероприятия

Этот API предоставляет методы для бронирования мест на мероприятия через билетный шлюз.

### Описание методов

[Swagger Link](https://app.swaggerhub.com/apis-docs/efimova.se/test.svkdigital/1.0.0)

## Установка проекта

Скопировать файл конфигурации:
```bash
cp .env.example .env
```
Прописать в .env данные для соединения с билетным шлюзом:
```bash
LEADBOOK_API_URL=[url]
LEADBOOK_BEARER_TOKEN=[token]
```

При необходимости сменить локальный адрес проекта:
```bash
APP_URL=http://localhost:8333
APP_PORT=8333
```

Провести начальную инициализацию (единоразово):
```bash
make init
make up
make key
```

Другие команды для Sail:
```bash
#запустить приложение
make up

#остановить приложение
make stop

#сбилдить Sail
make build

#перебилдить Sail
make rebuild
```

Запуск тестов:
```bash
make test
```



