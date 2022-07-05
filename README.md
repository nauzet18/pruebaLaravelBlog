<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
  Prueba técnica Blog aplimentado desde una API y proporciona una API para su consumo
</p>

## Sobre la prueba

## Ponerla en marcha

En el repo está la carpeta **dockerlaravelblog** solo es entar en ella y lanzar los comandos de **docker-compose** que se indican en el proceso de instalación.

0º Pues a contruir y a levantar

**docker-compose build**

**docker-compose up**

1º Instalar los paquetes de composer

**docker-compose exec -u1000 app composer install**

2º generar el app key

**docker-compose exec -u1000 app php artisan key:generate**

3º Ejecutar migraciones y seeders (No lo uso al final)

**docker-compose exec -u1000 app php artisan migrate**

**docker-compose exec -u1000 app php artisan db:seed**

4º crear el link a la carpeta storage

**docker-compose exec -u1000 app php artisan storage:link**

5º Instalar paquetes de nodemodules

**docker-compose run --rm -u1000 nodejs npm install**


## PHP CS Fixer en modo @Symfony
He configurado PHP CS Fixer como proponía la documentación, lo puse en la carpeta tools, al fianl lo commitee, para evitar problemas para q lo pruebe un tercero, pero yo opino que debería estar en vendor.
He configurado con .php-cs-fixer.php el modo @Symfony y las carpetas a excluir, seguro q me he dejado alguna.

Para tener los comandos guardados.

Ejecutar php-cs-fixer y que muestre los ficheros que se modificarián, sin llegar a modificarlo

**docker-compose exec -u1000 app tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --dry-run**

Ejecutar php-cs-fixer y que cambie los ficheros según las reglas.

**docker-compose exec -u1000 app tools/php-cs-fixer/vendor/bin/php-cs-fixer fix**

**TODO:** Estuve jugando con él al principio, pero luego el tiempo se me hechó encima... esto se queda para el futuro.

**AVISO:** Al final me lié y me puse a revisar y subir los cambios q me hizo, los test dice q todo OK.

## Phpstan
He instalado phpstan y lo he configurado en phpstan.neon

Para tener guardado el comando para lanzar phpstan, en phpstan.neon esta la condiguración

**docker-compose exec -u1000 app vendor/bin/phpstan analyse**

**TODO:** Estuve jugando con él al principio, pero luego el tiempo se me hechó encima, a ver si tengo tiempo y corrijo algunas partes. Mi yo de las 3 de la mañana... nop... esto se queda para el futuro.

## Swagger
He instalado swagger y he configurado para q se genere la documentación, lo tienen disponible en el siguiente enlace: [Api documentación de swagger](http://localhost/api/documentation)

Para tener guardado el comando de generación de la documentación

**docker-compose exec -u1000 app php artisan l5-swagger:generate**

## Implementado

## Mejoras

## Tiempo dedicado

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
