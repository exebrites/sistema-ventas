# Sistema de gestión de pedidos oliva - SGPO

MODIFICAR

## Introducción y objetivos


### Objetivos:



## 🌟 Resumen

### 🚀 Modulos

#### Funcionales

- Gestionar ABM de clientes
<!-- - Gestionar ABM de pedidos -->
<!-- - Gestionar ABM materiales -->
- Gestionar ABM productos
<!-- - Gestionar ABM diseños -->
- Gestionar ABM proveedores
<!-- - Gestionar ABM presupuesto para pedido -->
<!-- - Gestionar ABM oferta de materiales
- Actualización de precios de materiales -->
- Comunicación con usuarios

#### No funcionales

- Creacion y asignacion de roles
- Gestionar usuarios
<!-- - Generación de reportes -->
- Auditoría

## Tecnologias utilizadas

### Frontend

- Laravel Blade
- HTML, CSS y JavaScript valina
- Bootstrap 5
- AdminLTE 3

### Backend

- Laravel Framework 9
- MySQL version 15
- PHP version 8.1

### Otras tecnoligías

- Composer version 2.7
- Git version 2.39

## 🛠️ Guía rápida para correr el proyecto

1. Clonar el repositorio
2. Crear un archivo .env dentro de directorio raiz con sus variables de entorno:
> cp .env.example .env
> "De ser necesario cambie el nombre de la base de datos"
3. Ejecutar el siguiente comando para descargar las dependencias:
> composer install
4. Ejecutar el siguiente comando para generar la clave necesaria para laravel 
> php artisan key:generate
5. Ejecutar el siguiente comando para realizar las migraciones:
> php artisan migrate
> "Vea la estructura de carpertas migrations"
- php artisan migrate --path=database/migrations/base
- php artisan migrate --path=database/migrations/modelo1
- php artisan migrate --path=database/migrations/modelo2
- php artisan migrate --path=database/migrations/paquetes

6. Ejecute los seeders:
- php artisan db:seed --class=PermissionSeeder
permisos necesarios para ingresar al sistema
- php artisan db:seed --class=RoleSeeder
    Crea roles y permisos necesarios para ingresar al sistema
- php artisan db:seed --class=  UserSeeder 
 Crea un usuario ADMIN
   email:admin@gmail.com, password: admin

7. Ejecutar el siguiente comando para correr la aplicación:
> php artisan serve

8. Ejecutar 
>- npm install
>- npm run dev

