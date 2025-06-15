# <div align="center"> ✧ Solutech – Gestión de Avisos ✧  </div>
### <div align="center"> - Belén Ruiz Morales - </div>
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 📝 Descripción del Proyecto
Este proyecto propone una aplicación web orientada a la gestión de avisos de mantenimiento y pedidos para una empresa de servicio técnico. El objetivo principal es ofrecer una solución eficiente, intuitiva y accesible tanto para los clientes como para los miembros del equipo técnico y administrativo.

Para dar contexto a la aplicación, se ha creado una empresa ficticia: Solutech, especializada en el mantenimiento y reparación de impresoras para otras empresas. Además, cuenta con una tienda —tanto física como online— de mobiliario de oficina, donde se comercializan productos como sillas ergonómicas, escritorios, armarios y mesas de reuniones: todo lo esencial para equipar espacios de trabajo modernos.
<br><br>
![Captura de pantalla 2025-06-08 015235](https://github.com/user-attachments/assets/a088c4d2-e301-4179-a4f0-a6900403ce42)
<br>

## 🌐 Proyecto en Producción
El proyecto está desplegado en AWS y accesible públicamente: <br>
  🔗 URL de acceso: http://ec2-54-80-44-140.compute-1.amazonaws.com

## 🔐 Usuarios de Prueba (contraseña: password)
Cliente -> contacto@blueskyventures.es<br>
Trabajador -> ana.torres@solutech.com<br>
Admin -> webmaster@solutech.com<br>

## 👥 Perfiles de Usuario

### 🏢 Empresa
Ver máquinas registradas y sus especificaciones.
Acceso al historial de pedidos, con posibilidad de consultar su estado, editar o cancelar si aún no han sido procesados.
Consulta de avisos de avería, incluyendo historial y estado actual. Puede cancelar un aviso si su estado es "procesando".

### 🧑‍💼 Administrador
Gestión de avisos y pedidos.
Administración del catálogo de máquinas, con funciones para crear, editar o marcar como descatalogadas.
Control del inventario de productos y categorías asociadas a los avisos.
Posibilidad de asignar avisos a trabajadores y realizar seguimiento del estado de cada intervención.

### 🛠 Trabajador
Acceso al listado de avisos asignados, clasificados como "por empezar" o "en espera".
Visualización del catálogo de máquinas, incluyendo sus especificaciones, empresa asociada (si la tiene) e historial técnico de intervenciones.
Posibilidad de crear intervenciones técnicas tanto en los avisos que tenga asignados como sin aviso asignado.

### 🛠️ Lenguajes y Tecnologías
- **PHP:** Lenguaje principal.
- **Laravel:** Framework de desarrollo.
- **Livewire:** Para componentes dinámicos sin recargar la página.
- **Blade:** Motor de plantillas de Laravel.
- **MariaDB:** Base de Datos.
- **CSS personalizado:** Diseño visual adaptado sin frameworks externos.
- **JavaScript puro:** Para interacciones como el carrito y carrusel de imágenes.
- **SweetAlert:** Alertas dinámicas.
- **Font Awesome:** Iconos.
<br><br>

## 📖 Instalación y Configuración
```
# Clonar el repositorio
git clone https://github.com/beelenruiz/gestoeDeAvisos.git

# Ingresar al directorio del proyecto
cd gestionDeArticulos

#Instalar dependencias
npm install
composer install

# Configurar variables de entorno
cp .env.example .env

# Ejecutar migraciones y seeders para generar datos iniciales
php artisan migrate --seed

#Iniciar el servidor
composer dev  (->  ejecuta a la vez php artisan serve y npm run dev)
```
Accede al proyecto en tu navegador en la dirección http://localhost:8000/.
<br><br>

## 📸 Imágenes
![Captura de pantalla 2025-06-08 195016](https://github.com/user-attachments/assets/47e1c8d2-3571-4998-9c30-f60a1ac63773)
![Captura de pantalla 2025-06-08 192158](https://github.com/user-attachments/assets/64f655c4-3ac0-4a5e-9dd6-823813287ca6)
![Captura de pantalla 2025-06-08 193830](https://github.com/user-attachments/assets/360dd8d2-2eeb-4ae6-a1bf-8e158b915567)
![Captura de pantalla 2025-06-08 030353](https://github.com/user-attachments/assets/d8e37adb-c8ff-4a96-807b-6a733c2ca815)


## Licencia
Este proyecto está licenciado bajo la licencia [CC BY-NC-ND 4.0](https://creativecommons.org/licenses/by-nc-nd/4.0/).  
Esto significa que puedes compartirlo con atribución, pero no puedes usarlo con fines comerciales ni modificarlo.<br><br>
© 2025 beelenruiz

## 👥 Autora
**Belén Ruiz Morales**,  Estudiante de 2º DAW.

### ✉ Contacto
- belenrumo2005@gmail.com
- [mi perfil de linkedin](https://www.linkedin.com/in/belen-ruiz-499b8b275/)
