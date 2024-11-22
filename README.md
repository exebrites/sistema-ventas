# Sistema de gestión de pedidos oliva - SGPO

El negocio “Impresiones Oliva” se dedica al diseño y cartelería. Actualmente el negocio
realiza la recepción de pedidos de forma presencial o a través de redes sociales, luego de
definir el proyecto se pasa a producción para finalizar con el despacho o instalación del
producto ya terminado.

## Introducción y objetivos

El negocio “Impresiones Oliva” se dedica al diseño y cartelería. Actualmente el negocio
realiza la recepción de pedidos de forma presencial o a través de redes sociales, luego de
definir el proyecto se pasa a producción para finalizar con el despacho o instalación del
producto ya terminado.

### Objetivos:

- Permitir que el cliente realice la gestión del pedido de forma online
- Presentar un presupuesto estimativo del proyecto al cliente
- Gestionar compra de materiales a los proveedores
- Facilitar la interacción entre el cliente y el negocio, así como el feedback con
respecto al proyecto.
- Dar visión del flujo de trabajo

## 🌟 Resumen

### 🚀 Modulos

#### Funcionales

- Gestionar ABM de clientes
- Gestionar ABM de pedidos
- Gestionar ABM materiales
- Gestionar ABM productos
- Gestionar ABM diseños
- Gestionar ABM proveedores
- Gestionar ABM presupuesto para pedido
- Gestionar ABM oferta de materiales
- Actualización de precios de materiales
- Comunicación con usuarios

#### No funcionales

- Creacion y asignacion de roles
- Gestionar usuarios
- Generación de reportes
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
4. Ejecutar el siguiente comando para generar la clave necesaria para laravel :
> php artisan key:generate
5. Ejecutar el siguiente comando para realizar las migraciones:
> php artisan migrate
6. Ejecutar el siguiente comando para correr la aplicación:
> php artisan serve

