Prueba tecnica blog laravel

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
