# HOLA SYMFONY CRUD APP
This is a basic web app developed with Symfony 4.

## Technical requirements:
- PHP 7.4
- MySQL 5.7
- Symfony 4.4
- Docker

## Run with docker

1. docker pull sebastillar/hola-symfony_app

2. docker run -ti -p 8080:8080 --name hola sebastillar/hola-symfony_app:latest bash

3. git clone https://github.com/sebastillar/hola-symfony-crud-app.git

4. cd hola-symfony-crud-app

5. composer install

6. php bin/console doctrine:database:create

7. php bin/console --env=test doctrine:schema:create

8. php bin/console make:migration

9. php bin/console doctrine:migrations:migrate

10. php bin/console doctrine:fixtures:load


## In browser
1. Go to localhost:8080/hola-symfony-crud-app/public/login


## Technical Debt
1. Restful API it's not implemented

## Test
1. php bin/console --env=test doctrine:database:create 

2. php bin/console --env=test doctrine:schema:create

3. php bin/console doctrine:fixtures:load

4. php ./vendor/bin/phpunit

## Bugs
- Since deployed with docker container, environment vars are ignored so, database connection doesn't work.
