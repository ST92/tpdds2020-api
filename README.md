# Delivery Club App #

### Inicio de proyecto ###
* Clonar repositorio
* Asegurar tener configurado PHP 7.1 en cli
* Ejecutar `composer install -o`
* Crear carpeta en var/jwt
* Ejecutar `openssl genrsa -out var/jwt/private.pem -aes256 4096`
* Ejecutar `openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem`
* Crear base de datos `php bin/console doctrine:schema:update --force`
* Cargar los fixtures `php bin/console doctrine:fixtures:load`

### Inicio de desarrollo ###
* Ejecutar `php bin/console server:run`
* Abrir en navegador -> http://127.0.0.1:8000

### Generador de código ###
* Comandos disponibles `php bin/console list make`
* Generar controlador `php bin/console make:controller Admin\NombreController`

### Doctrine
* Consulta de actualización de schema de la base de datos `php bin/console doctrine:schema:update --dump-sql`
* Actualizar schema de la base de datos `php bin/console doctrine:schema:update --force`

### Router
`php bin/console debug:router`

### Despliegue