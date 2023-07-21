
### Passo a passo
Clone Repositório
```sh
git clone -b https://github.com/danielrosenosi/scriba-laravel-10.git scriba
```
```sh
cd scriba
```


Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=nome_usuario
DB_PASSWORD=senha_aqui

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Suba os containers do projeto
```sh
docker compose up -d
```


Acesse o container app
```sh
docker compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```

Fora do container Docker, instale as demais dependências do projeto
```sh
npm install
```

Acesse o projeto
[http://localhost:8989](http://localhost:8989)