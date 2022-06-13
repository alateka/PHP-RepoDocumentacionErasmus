## Gran parte del desarrollo fue realizado por Antonio Cantos & José Miguel López.
### El desarrollo de la API para la conexión de la APP Erasmus+ al igual que la propia APP fue desarrollada por Alberto Pérez Fructuoso.

# Configuración del entorno de la aplicación en local Windows
- <p>Para la configuración de la aplicación y su correcto uso, deberemos tener como requisitos PHP 8.0 y tener composer instalado.
- La lista de pasos a seguir sería la siguiente:</p>
- - Descargamos la carpeta del proyecto. se puede descargar en un rar o mediante el comando `git clone (url)`.
- - Nos vamos a la carpeta y ejecutamos el comando `composer install`.
- - Ejecutamos el comando `composer require laravel/jetstream`.
- - Hacemos una copia del .env.example con el comando `cp .env.example .env`
- - Rellenamos los datos en el editor de texto. Los datos necesarios son el nombre de la bbdd, el usuario y la contraseña para conectarse a ésta.
- - Generamos una key mediante el comando `php artisan key:generate`.
