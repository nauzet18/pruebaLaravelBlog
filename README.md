<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
  Prueba técnica Blog aplimentado desde una API y proporciona una API para su consumo
</p>

## Sobre la prueba

En esta prueba se ha pedido a groso modo hacer un blog que muestre el dato en modo web con una vista donde listar todos los post y una vista para mostrar un post.
Además se pide que se exponga una API para consumir los post y para poder hacer un create.

## Implementado

Bueno se me ha ido un poco de las manos, por q ademas de lo necesario, he creado un service que se conecta a la API que me pasaron de ejemplo para basarme en ella. Yo directamente la usé y es lo que muestra el bog.

Por otro lado al hacer unit test, me hice una versión del service que implementaba el repositorio guardando los datos en memoria y creando los elementos con un Factory propio, esto me dio la lata cosa mala.

Bueno decir q empecé con los feature test, para hacer una comprobación sencilla que las rutas y controladores estaban bien y despues pasé a los unit test, cree el servicio en memoria y luego pasé al servie de la API. Lo pueden ver en los commits.

Bueno hasta aquí la explicación de lo relevante que he realizado.

**De lo opcional**

**He usado php 8.1**, pero digamos q no he cuidado al detalle usar sus caracteristicas.

**He usado la ultima version de Laravel 9**, pero digamos q no he cuidado al detalle usar sus caracteristicas.

**He PHP CS Fixer en modo @Symfony**, pero digamos que no lo integré en el proceso de creación y lo ejecuté al final.

**He usado Webpack, tailwindcss**, pero al final SCSS no lo usé por falta de tiempo en configurarlo.

**He Swagger/OpenAPI**, en el controlador de la API, rellené los anotate, espero que bien. No había usado antes este generador de documentación.

## Ponerla en marcha

Copiar el .env de laravel de ejemplo q he creado y adaptarlo, si creen oportuno. Yo con lo que he puesto de ejemplo vale.

**cp .env.example .env**

En el repo está la carpeta **dockerlaravelblog** solo es entar en ella y lanzar los comandos de **docker-compose** que se indican en el proceso de instalación.

Entrar en la carpeta

**cd dockerlaravelblog**

Copiar y adaptar el .env de docker-compose. Especial interes en ENV_UID_USER y ENV_GID_GROUP, poner tu id de usuario. Esto se puede sacar con un ls -n (q en vez de poner el nombre y grupo, pone los identificadores). Esto en mac tene impotancia, en ubuntu si solo tienes un usuario es 1000 y en windows, ni idea no trabajo en windwos hace mucho.

**cp .env_example .env**

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

** Listo, ya puedes entrar en la web **

Ahora ya es solo usar la url en el navegador para web la web

http://localhost/

Y usar el postman para acceder a la api

http://localhost/api/posts/1

## Ejecutar los tests

Pues para eso solo hace falta ejectuar el siguiente comando

**docker-compose exec -u1000 app php artisan test**

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

## Mejoras

Las mejoras que realicé, como consumir la API externa al traer todo los elementos y poblarlo con los datos de user iba lento. Implementé un paginador para el repositorio y luego con esto alimentaba la web.

**Cosas que se me quedaron** usar el PhpStan en serio, como hace tiempo no uso estas herramientas, (en RoR lo usé un año, pero en php no) tenía flata de practiva y lo sacrifiqué.

Así que el objetivo de tener todos los tipos bien puestos, yo creo que no los cumplí. Me centré en crear y crear. Por lo que la organización, nombres y tipado fuerte se vio mermado.

Hubiera hecho mejores y mas test, pero los dejé planteados y marcados como no implementado.

No me lio más, ha estado divertido y me sirve para salir de la dinámica de hacer las cosas para funcionen. Con un equipo de trabajo que trabaje de esta manera, se pueden evolucionar los conocimientos y mejores practicas.

## Tiempo dedicado

Pues siendo sincero, se me fue de las manos. He trabajado con el git, para que quede mas o menos registrado los tiempos y en los comentarios pueden ver como y las horas.
Pero les hago un resumen, si el crear el proyeto laravel lo hago una semana antes, para tener una instalación limpia. Es el viernes 01/07 cuando le dedico unas 3 horas y me pongo leer e instalar php php-cs-fixer y PhpStan.

El sabado 02/07 a eso de las 12 me pongo leer e instalar Swagger/OpenAPI, tailwindcss. Es ya cuado por la tarde me pongo serio y dejo de estar divagando leyendo por internet cosas q me llaman la atención de como hacer y me pongo.
A partir de aquí, digamos que el sabado estoy 8 horas en serio.

El domingo 03/07, sigo en serio ya que se hecha el tiempo encima y le dedico todo el día desde las 11:00 hasta las 02::00 de la mañana. Aqui con parones por el tema de cuidar al familar.
Digamos que unas 10 horas de trabajo.

El lunes 04/07, despues de trabajar creo q desde las 17:00 hasta las 4:00, que ya aqui no comiteo tanto que se me hechó todo el tiempo encima. Es cuando me pongo a hacer la parte de la web, refactorizaciones, el READMI.md etc.

En resumen 3 + 8 + 10 + 12 = **23h** en 3 o 4 días.

Solo decir, que ha estado entretenido, una buena manera de hacer el turno de cuidar a un familiar y divertirse.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
