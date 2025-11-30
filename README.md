# Sistema de Gestión de Denuncias - Municipio

## 📋 Descripción

Aplicación web desarrollada para gestionar denuncias ciudadanas sobre problemas urbanos (baches, mal estado de parques, recolección de basura, etc.). El sistema permite crear, editar, eliminar, buscar y visualizar denuncias con paginación.

## 🛠️ Stack Tecnológico

- **Backend**: PHP 7.4+
- **Base de Datos**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework CSS**: Bootstrap 5.3.0
- **Arquitectura**: MVC (Modelo-Vista-Controlador)
- **Servidor**: XAMPP / Apache

## 📁 Estructura del Proyecto

```
denuncias-app/
├── app/
│   ├── config/
│   │   └── database.php          # Configuración de conexión a BD
│   ├── controllers/
│   │   └── DenunciaController.php # Controlador principal
│   ├── models/
│   │   └── Denuncia.php          # Modelo de datos
│   └── views/
│       ├── header.php            # Cabecera común
│       ├── footer.php            # Pie de página común
│       ├── lista.php             # Vista de listado con búsqueda y paginación
│       ├── crear.php             # Vista de creación
│       └── editar.php            # Vista de edición
├── public/
│   ├── assets/
│   │   ├── css/
│   │   │   └── style.css         # Estilos personalizados
│   │   └── js/
│   │       └── app.js            # JavaScript personalizado
│   └── index.php                 # Punto de entrada
└── README.md
```

## 🗄️ Base de Datos

### Crear Base de Datos

```sql
CREATE DATABASE denuncias_jimenezrenzo;

USE denuncias_db;

CREATE TABLE denuncias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    descripcion VARCHAR(255),
    ubicacion VARCHAR(150),
    estado VARCHAR(20),
    ciudadano VARCHAR(100),
    telefono_ciudadano VARCHAR(15),
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### Configuración de Conexión

Editar `app/config/database.php` con tus credenciales:

```php
private $host = "localhost";
private $db_name = "denuncias_jimenezrenzo";
private $username = "root";
private $password = "";
```

## 🚀 Instalación

1. **Clonar o descargar el proyecto** en la carpeta `htdocs` de XAMPP:
   ```
   D:\XAMPP\htdocs\denuncias-app
   ```

2. **Crear la base de datos** en phpMyAdmin ejecutando el script SQL proporcionado.

3. **Configurar la conexión** en `app/config/database.php` si es necesario.

4. **Iniciar Apache y MySQL** desde el panel de control de XAMPP.

5. **Acceder a la aplicación**:
   ```
   http://localhost/denuncias-app/public/
   ```

## ✨ Funcionalidades

### ✅ Gestión de Denuncias
- **Crear**: Formulario para registrar nuevas denuncias
- **Editar**: Modificar información de denuncias existentes
- **Eliminar**: Eliminar denuncias con confirmación
- **Listar**: Visualización de todas las denuncias

### 🔍 Búsqueda
- Búsqueda por **título**
- Búsqueda por **ciudadano**
- Búsqueda por **ubicación**
- Búsqueda en tiempo real con filtrado

### 📄 Paginación
- 10 registros por página
- Navegación entre páginas
- Indicador de página actual
- Total de registros mostrado

### 🎨 Estados de Denuncias
- **Pendiente** (Amarillo)
- **En proceso** (Azul)
- **Resuelto** (Verde)

### 📱 Diseño Responsive
- Adaptable a dispositivos móviles
- Tabla responsive con vista de tarjetas en móviles
- Navegación colapsable en pantallas pequeñas
- Formularios optimizados para móviles

## 🎯 Características Técnicas

### Arquitectura MVC
- **Modelo**: Lógica de acceso a datos (`Denuncia.php`)
- **Vista**: Presentación de datos (`views/`)
- **Controlador**: Lógica de negocio (`DenunciaController.php`)

### Seguridad
- Uso de PDO con prepared statements
- Validación de datos en formularios
- Sanitización de salida con `htmlspecialchars()`
- Validación de métodos HTTP

### Responsive Design
- Bootstrap 5.3.0 para diseño responsive
- Media queries personalizadas
- Tabla adaptativa para móviles
- Formularios con validación HTML5

## 📝 Uso

### Crear una Denuncia
1. Hacer clic en "Nueva Denuncia"
2. Completar el formulario
3. Hacer clic en "Guardar Denuncia"

### Buscar Denuncias
1. Usar el campo de búsqueda en la parte superior
2. Escribir título, ciudadano o ubicación
3. Los resultados se filtran automáticamente

### Editar una Denuncia
1. Hacer clic en "Editar" en la fila correspondiente
2. Modificar los campos necesarios
3. Cambiar el estado si es necesario
4. Hacer clic en "Actualizar Denuncia"

### Eliminar una Denuncia
1. Hacer clic en "Eliminar" en la fila correspondiente
2. Confirmar la eliminación

## 🔧 Requisitos del Sistema

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Apache (XAMPP recomendado)
- Navegador web moderno

## 📊 Competencias Evaluadas

Este proyecto demuestra competencias en:

- **Modelado de software**: Arquitectura MVC bien estructurada
- **Desarrollo de aplicaciones**: Aplicación web dinámica con PHP y MySQL
- **Tecnologías web**: Uso de HTML5, CSS3, JavaScript y Bootstrap
- **Analítica de datos**: Gestión y visualización de datos de denuncias

## 👨‍💻 Autor

Desarrollado como parte de la Prueba de Nivel de Logro de Competencias - VIII Ciclo

## 📄 Licencia

Este proyecto es de uso educativo.

