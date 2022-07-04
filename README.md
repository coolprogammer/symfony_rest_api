# symfony_rest_api
developed the simple rest api using symfony 5.4 LTS

Creatre the symfony skelton uisng comond line
composer create-project symfony/skeleton:"5.4.*" symfony_rest_api
#### GET /api/v1/movies/{id}

```
GET /api/v1/movies/{id}
```

Example response:

```
{
    "name": "The Titanic",
    "casts":[
        "DiCaprio",
        "Kate Winslet"
    ],
    "release_date": "18-01-1998",
    "director": "James Cameron",
    "ratings": {
        "imdb": 7.8,
        "rotten_tomatto": 8.2
    }
}
```
```
create & migrate entity of movies commond
```
php bin/console make:entity

php bin/console make:migration

php bin/console doctrine:migrations:migrate

php bin/console make:controller MovieController

```
Start Server using PHP
```
php -S localhost:8000 -t public/


now hit the API using postman 
