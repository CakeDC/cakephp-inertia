## CakePHP

CakePHP installation and configuration example using Docker

```
$> composer create-project --prefer-dist cakephp/app:~4.5 inertia_app
$> cd inertia_app
$> cp config/app_local.example.php config/app_local.php
```

## Docker

create docker-compose.yml file as
```
version: '3'
services:
  psql13:
    image: postgres:13
    container_name: inertia-app-postgres13
    volumes:
      - ./tmp/data/inertia-postgres13__db:/var/lib/postgresql:delegated
    environment:
      - POSTGRES_USER=my_app
      - POSTGRES_PASSWORD=secret
      - POSTGRES_DB=my_app
      - PGUSER=my_app
      - PGDATABASE=my_app
      - PGPASSWORD=secret
    ports:
      - '7432:5432'

  cakephp:
    image: webdevops/php-nginx:8.1
    container_name: inertia-app-cakephp
    working_dir: /application
    volumes:
      - ./:/application:cached
      - ~/.ssh:/home/application/.ssh:ro
    environment:
      - WEB_DOCUMENT_ROOT=/application/webroot
      - DATABASE_URL=postgres://my_app:secret@inertia-app-postgres13:5432/my_app
    ports:
      - "9099:80"
```

launch container

```
$> docker-compose up -d
```

go to http://localhost:9099/