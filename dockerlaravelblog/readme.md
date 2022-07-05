Prueba tecnica blog laravel (este readme es un cajon desastre, leer el que está en la raiz)

Una vez levantado el docker-compouse

docker-compose exec app bash
docker-compose exec database bash
docker-compose exec -u1000 app php artisan tinker


1º Instalar los paquetes de composer
docker-compose exec -u1000 app composer install

2º generar el app key
docker-compose exec -u1000 app php artisan key:generate

3º Ejecutar migraciones y seeders
docker-compose exec -u1000 app php artisan migrate
docker-compose exec -u1000 app php artisan db:seed

4º crear el link a la carpeta storage
docker-compose exec -u1000 app php artisan storage:link




Por si se quiere ejecutar el npm desde el docker... pero no es necesario.. yo es q me peta en uno de los ordenadores
docker-compose run --rm -u1000 nodejs npm run watch
docker-compose run --rm -u1000 nodejs npm run dev
docker-compose run --rm -u1000 nodejs npm run production
docker-compose run --rm -u1000 nodejs npm install

5º Ya que el proyecto usa passport, hay que crear el fichero de keys con el comando
docker-compose exec -u1000 app php artisan passport:keys


Comandos utiles

Migraciones y DB
docker-compose exec -u1000 app php artisan schema:dump

docker-compose exec -u1000 app php artisan migrate:status
docker-compose exec -u1000 app php artisan migrate
docker-compose exec -u1000 app php artisan migrate:rollback

Listar por consola las rutas
docker-compose exec -u1000 app php artisan route:list


docker-compose exec -u1000 app php artisan make:mail SendTestMail

//-------------------- metiendo PHP CS Fixer en modo @Symfony
//La web propone instalaro en una carpeta propia para tener su composer.json propio. y como esto se ejecuta desd dockerlaravelblog
NOTA: he metido el directorio tools en el repo... esto no debería hacerlo.. pero.. voy a garantizar q lo puedan ejecutar.
mkdir --parents ../tools/php-cs-fixer

docker-compose exec -u1000 app composer require --working-dir=./tools/php-cs-fixer friendsofphp/php-cs-fixer

tools/php-cs-fixer

Ejecutar php-cs-fixer y que muestre los ficheros que se modificarián. Esto lo estoy ejecutando para ver si me coge la configuración y los exclude.
docker-compose exec -u1000 app tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --dry-run

Ejecutar php-cs-fixer y que cambie los ficheros según las reglas.
docker-compose exec -u1000 app tools/php-cs-fixer/vendor/bin/php-cs-fixer fix

//-------------------- metiendo phpstan en el proyecto
https://phpstan.org/user-guide/getting-started
Despues de ver la web veo que tiene una versión de instalalo con el composer o tengo con docker.
https://phpstan.org/user-guide/docker

La dorma de tenerlo con docker no me convence por que tendría q estar instalando todas las dependencias y eso ya lo hice en el servicio app. Aso q nada es solo hacer el composer require y luego ejecutarlo como otro comando mas con sus parámetros.

docker-compose exec -u1000 app composer require --dev phpstan/phpstan
docker-compose exec -u1000 app vendor/bin/phpstan analyse --level=max app tests
docker-compose exec -u1000 app vendor/bin/phpstan analyse

0 basic checks, unknown classes, unknown functions, unknown methods called on $this, wrong number of arguments passed to those methods and functions, always undefined variables
La reglas de cada nivel,  para la prueba usaremos el nimel maximo

1- possibly undefined variables, unknown magic methods and properties on classes with __call and __get
2- unknown methods checked on all expressions (not just $this), validating PHPDocs
3- return types, types assigned to properties
4- basic dead code checking - always false instanceof and other type checks, dead else branches, unreachable code after return; etc.
5- checking types of arguments passed to methods and functions
6- report missing typehints
7- report partially wrong union types - if you call a method that only exists on some types in a union type, level 7 starts to report that; other possibly incorrect situations
8- report calling methods and accessing properties on nullable types
9- be strict about the mixed type - the only allowed operation you can do with it is to pass it to another mixed



//-------------------------------- Swagger/OpenAPI  con Laravel
NOTA: Veo que el paquete q se usa para laravel es:
  https://github.com/DarkaOnLine/L5-Swagger
  https://swagger.io/specification/

Y q solo está hasta laravel 8,  veo que hay gente q le da problemas y uno propone en https://github.com/DarkaOnLine/L5-Swagger/issues/449
instalar el paqute con todas las dependencias.

docker-compose exec -u1000 app composer require darkaonline/l5-swagger --with-all-dependencies
NOTA: este no lo ejecute
docker-compose exec -u1000 app php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"

Para ver la documentación generada es lanzar el comando
docker-compose exec -u1000 app php artisan l5-swagger:generate


Luego visitar http://localhost/api/documentation


Install tailwindcss
// https://tailwindcss.com/docs/guides/laravel#mix
docker-compose run --rm -u1000 nodejs npm install -D tailwindcss postcss autoprefixer
docker-compose run --rm -u1000 nodejs npx tailwindcss init


docker-compose exec -u1000 app composer require guzzlehttp/guzzle



docker-compose exec -u1000 app php artisan make:provider RepositoryServiceProvider


docker-compose exec -u1000 app php artisan make:factory PostFactory


docker-compose exec -u1000 app php artisan tinker

docker-compose exec -u1000 app php artisan make:resource PostResource
docker-compose exec -u1000 app php artisan make:resource PostCollection





$post = App\Factories\PostFactory::new()->make();
$posts = App\Factories\PostFactory::new()->times(5)->make();






docker-compose exec -u1000 app php artisan test --coverage

docker-compose exec -u1000 app php artisan test
docker-compose exec -u1000 app php artisan make:test PostTest --unit


php artisan make:resource UserResource



docker-compose exec -u1000 app php artisan test --testsuite=Unit --stop-on-failure
docker-compose run --rm -u1000 app ./vendor/bin/phpunit --testsuite Unit --filter="PersistenceServiceInMemoryTest"
docker-compose run --rm -u1000 app ./vendor/bin/phpunit --filter="PersistenceServiceInMemoryTest"

docker-compose run --rm -u1000 app ./vendor/bin/phpunit --testsuite Feature
docker-compose exec -u1000 app php artisan test --testsuite=Feature

docker-compose run --rm -u1000 app ./vendor/bin/phpunit --testsuite Unit
docker-compose exec -u1000 app php artisan test --testsuite=Unit

-----


docker-compose run --rm -u1000 nodejs npm run dev
docker-compose run --rm -u1000 nodejs npm run watch



//--------------------------------




///----------- CAJON DESASTRE
Cambios en el php.ini
Poner sys_temp_dir, a una ruta donde pueda escribir php
sys_temp_dir = /var/www/storage/tmp


Obtener todos los permisos definidos
Illuminate\Support\Facades\Gate::abilities()











docker-compose exec -u1000 app composer require spatie/laravel-honeypot

docker-compose exec -u1000 app php artisan make:migration add_fields_to_cvs_table
docker-compose exec -u1000 app php artisan make:migration AddNewsletterFieldToUsers
----------


//Create migrate
php artisan make:migration:schema create_articles_table --schema="name:string"

docker-compose exec -u1000 app php artisan migrate:fresh

docker-compose exec -u1000 app php artisan bl5:model File
docker-compose exec -u1000 app php artisan bl5:request FileRequest
docker-compose exec -u1000 app php artisan make:migration create_filess_table
docker-compose exec -u1000 app php artisan make:seeder Categories

docker-compose exec -u1000 app php artisan app:setup


app()->setLocale('fr');

docker-compose exec -u1000 app composer require astrotomic/laravel-translatable

Crear un modelo de traducción y su migración
docker-compose exec -u1000 app php artisan make:model LevelTranslation -m




docker-compose exec -u1000 app php artisan vendor:publish --provider="Spatie\Feed\FeedServiceProvider" --tag="feed-config"

config/feed.php


docker-compose exec -u1000 app php artisan make:test UserTest

docker-compose exec -u1000 app php artisan test
docker-compose exec -u1000 app php artisan make:test UserTest



Para quitar este error q sale en la consola...  tengo q leerme y ver si definiendo un extra host, se solventa.
lo q no me gusta es tener q poner la IP
http://blog.chen-hongyi.com/?p=697

Xdebug: [Step Debug] Could not connect to debugging client. Tried: host.docker.internal:9003 (through xdebug.client_host/xdebug.client_
port) :-(

