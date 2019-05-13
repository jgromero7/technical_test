# Technical Test


Este proyecto está realizado en php con el framework de laravel 5.8, este proyecto tiene una interfaz simple con la cual puede realizar búsquedas y comparación de nombres
  - Registro de Usuario 
  - Inicio de Sesión
  - Gestión de búsquedas y comparación de nombres, según base de datos

### Tecnología

Technical Test usa varios proyectos de código abierto para funcionar correctamente:

* [Laravel 5.8](https://laravel.com/docs/5.8) - Se uso este framework para el desarrollo de esta aplicación.
* [mysql](https://www.mysql.com/) - Se uso como motor de base de datos para gestionar los registros de la aplicación.
* [laravel-dompdf](https://github.com/barryvdh/laravel-dompdf) - Puede crear una nueva instancia de DOMPDF y cargar una cadena HTML, archivo o nombre de vista. Puede guardarlo en un archivo, transmitirlo (mostrar en el navegador) o descargarlo.

### Clonar Repositorio
```sh
$ git clone URL_REPOSITORY 
```

### Installation

Technical Test requiere [PHP7.2.4](https://www.php.net/) para ejecutarse.

Instale las dependencias y devDependencies e inicie el servidor.
```sh
$ cd technical_test
$ composer install 
```

Crear base de datos en mysql, como recomendación y siguiendo los valores del archivo .env, agregar la base de datos con el siguiente nombre
```sh
    DB_DATABASE=technical_test_db 
```

Ya creada la base de datos ejecutamos las migraciones creadas en el proyecto
```sh
$ php artisan migrate
```

#### Importar información de Diccionario
Importar en la base de datos creada el archivo  [dictionary.sql](https://github.com/jgromero7/technical_test/blob/master/sql/dictionary.sql) que se encuentra en el proyecto [sql/dictionary.sql](https://github.com/jgromero7/technical_test/blob/master/sql/dictionary.sql) con esto tenemos toda la data necesaria para tener nuestro proyecto en ejecución y funcionamiento


#### Ejecutar el proyecto
```sh
$ php artisan serve
```

Verifique la implementación navegando a la dirección de su servidor en su navegador preferido.
```sh
127.0.0.1:8000 || http://localhost:8000
```

##### Información adicional
Rutas::
```sh
GET /search-names Muestra la interfaz para realizar la búsqueda de nombres
GET /login Muestra un formulario para el inicio de sesión de usuario
POST /search-names recurso del webservice, se puede acceder con autenticación de usuario X-CSRF-TOKEN
```

Autor: José Romero
----
**Software Libre!**



