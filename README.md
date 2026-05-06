# Proyecto Bienes Raíces MVC 🏠
Este proyecto es una aplicación web dinámica desarrollada bajo la arquitectura **Model-View-Controller (MVC)**. El sistema permite la gestión integral de un sitio web de bienes raíces, facilitando la administración de propiedades, vendedores y usuarios.

<br>

## ⚙️ Arquitectura y Lógica
La aplicación se apoya en una base de datos relacional MySQL, donde la lógica de negocio se estructura de la siguiente manera:

- **Gestión de Propiedades y Vendedores:** Las propiedades están vinculadas a vendedores mediante llaves foráneas, permitiendo una gestión de datos normalizada y eficiente.

- **Sistema de Autenticación:** Cuenta con una tabla dedicada a usuarios, implementando el manejo seguro de credenciales mediante el hash de contraseñas para garantizar la privacidad y seguridad.

- **Control de Acceso:** Se ha implementado una capa de seguridad condicional que restringe la visualización y ejecución de acciones (Crear, Actualizar, Eliminar) exclusivamente a usuarios administradores.
<br>

<div align="center">
  <a href="https://bienesraices-juancholopodous.sao.dom.my.id/"><img src="https://raw.githubusercontent.com/juancholopodous/Bienes_Raices_MVC/main/Media%20GitHub/Portada2.gif" style="width:100%;"/>
</div>

<br>

## 🛠️ Tecnologías y Dependencias
Para lograr automatización y seguridad, el proyecto hace uso de las siguientes librerías de **Composer**:

- `intervention/image`: Manipulación y redimensionamiento de imágenes cargadas al sistema.

- `phpmailer/phpmailer`: Automatización del envío de formularios de contacto desde las vistas públicas.

- `vlucas/phpdotenv`: Gestión de variables de entorno para proteger datos sensibles (como credenciales de base de datos) en archivos de configuración.

<br>

## 👨‍💻 Panel de Administración (CRUD)
El sistema cuenta con un panel de control robusto diseñado para la gestión de contenido en tiempo real. Desde esta sección, los administradores pueden realizar operaciones de **CRUD** (*Create*, *Read*, *Update*, *Delete*) tanto sobre las **Propiedades** como sobre los **Vendedores**.

Cualquier cambio realizado en el panel impacta inmediatamente en la visualización de los anuncios y el blog público. A continuación, puedes ver este proceso en acción:
<br>

<br>

## ⚠️ Nota Importante sobre el Despliegue
Este proyecto es una aplicación de servidor (Backend PHP + MySQL). Debido a que GitHub Pages es un servicio diseñado exclusivamente para contenido estático, no es posible alojar la funcionalidad completa del proyecto aquí. Por lo que el enlace lleva a los servidores de [DOM Cloud](https://domcloud.co/) donde es procesado por la plataforma, eventualmente el enlace podría caerse si las políticas de la plataforma cambian ya que la misma es de uso gratuito.
<br>

Si el servidor llega a estar caido, dejo un enlace a una versión simplificada (estática) del [proyecto](https://github.com/juancholopodous/Bienes_Raices) **Bienes Raices** con fines visuales. 

<br>
Para ejecutar la versión completa con la lógica de MVC, el sistema de base de datos y la autenticación, es necesario clonar el repositorio y correrlo en un entorno local (como XAMPP, Laragon o Docker) configurando un servidor Apache/Nginx y MySQL.
<br>
<br>

>Dejo un archivo .env.example para quien tenga interes en probar el código, y de este modo sepa qué variables debe configurar. Además agrego un 
>archivo con extensión SQL (base_crud.sql) en la raíz para que se pueda **importar** la estructura de la base de datos qué utilicé.

<br>
<br>

<div align="right">
Desarrollado con arquitectura MVC por <a href="https://github.com/juancholopodous">Juan S Roth</a>.
</div>
