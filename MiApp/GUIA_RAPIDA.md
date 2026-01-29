# Guía Rápida - Sistema CRUD Alumnos

## 🎯 Flujo de Trabajo

### 1. **Inicio de Sesión**
```
Acceso: index.php?accion=login
- Usuario: (según configuración)
- Contraseña: (según configuración)
```

### 2. **Menú Principal**
```
Acceso: index.php?accion=menu
- Opciones disponibles después de autenticarse
```

### 3. **Registrar Alumno**
```
Acceso: index.php?accion=registrarAlumno

Campos obligatorios:
✓ Cédula: Identificador único
✓ Nombres: Nombre completo
✓ Apellidos: Apellidos del alumno
✓ Correo: Email válido (validación en servidor)
✓ Teléfono: Número telefónico
✓ Fecha de Nacimiento: Formato date (YYYY-MM-DD)
✓ Carrera: Seleccionar de lista dinámica

Validaciones:
- Todos los campos requeridos
- Email debe ser válido (XXX@XXX.XXX)
- Carrera debe ser seleccionada

Resultado:
- Éxito: Alerta verde + mensaje "Alumno registrado correctamente"
- Error: Alerta roja + mensaje específico del error
```

### 4. **Consultar Alumnos**
```
Acceso: index.php?accion=consultarAlumnos

Funcionalidades:
- Tabla con listado completo de alumnos
- Paginación: 8 alumnos por página
- Búsqueda por número de página

Acciones por alumno:
👁️  VER: Abre modal con todos los detalles
✏️  EDITAR: Formulario para actualizar datos
🗑️  ELIMINAR: Borra el registro (con confirmación)

Información mostrada:
| ID | Cédula | Nombres | Apellidos | Correo | Acciones |
```

### 5. **Editar Alumno**
```
Acceso: index.php?accion=editarAlumno&id=XXX

Permite modificar:
- Cédula
- Nombres
- Apellidos
- Correo
- Teléfono
- Fecha de Nacimiento

Resultado:
- Actualizado: Vuelve a tabla con mensaje "Alumno actualizado correctamente"
- Sin cambios: Vuelve a tabla con advertencia "No se realizaron cambios"
```

### 6. **Eliminar Alumno**
```
Acceso: index.php?accion=eliminarAlumno&id=XXX

Confirmar eliminación:
- ¿Estás seguro de eliminar este alumno?

Resultado:
- Éxito: Mensaje "Alumno eliminado correctamente"
- Error: Mensaje "Ocurrió un error al eliminar"
```

---

## 🔐 Seguridad Implementada

✓ **Autenticación**: Sesión protegida
✓ **Validación**: Email y campos requeridos
✓ **XSS Prevention**: htmlspecialchars() en salidas
✓ **CSRF Ready**: Estructura preparada
✓ **SQL Injection Protected**: PDO con parámetros

---

## 📁 Estructura de Archivos

```
MiApp/
├── index.php                    # Controlador frontal
├── assets/
│   └── js/alerts.js            # Funcionalidad de modales y alertas
├── bd/
│   └── conexion.php            # Conexión a base de datos
├── controlador/
│   └── AlumnoControlador.php    # Lógica de negocio
├── dao/
│   └── AlumnoDao.php           # Acceso a datos
├── modelo/
│   └── Alumno.php              # Clase modelo
└── vista/
    ├── alumno/
    │   ├── registrar.php       # Formulario de registro
    │   ├── consultar.php       # Tabla de listado
    │   └── editar.php          # Formulario de edición
    └── layout/
        ├── header.php          # Encabezado (Bootstrap)
        └── footer.php          # Pie de página
```

---

## 🎨 Colores y Estilos Bootstrap

| Elemento | Color | Clase |
|----------|-------|-------|
| Éxito | Verde | alert-success |
| Error | Rojo | alert-danger |
| Advertencia | Amarillo | alert-warning |
| Información | Azul | alert-info |
| Botón Ver | Azul Claro | btn-info |
| Botón Editar | Naranja | btn-warning |
| Botón Eliminar | Rojo | btn-danger |
| Botón Nuevo | Verde | btn-success |

---

## 🐛 Troubleshooting

### ❓ "Todos los campos son requeridos"
→ Completar todos los campos del formulario

### ❓ "El correo electrónico no es válido"
→ Usar formato: usuario@dominio.com

### ❓ "Error al registrar el alumno"
→ Verificar conexión a BD, puede ser problema de base de datos

### ❓ No aparecen alumnos en tabla
→ Verificar que se hayan registrado alumnos primero

### ❓ Modal no abre
→ Verificar que assets/js/alerts.js esté en la ruta correcta

---

## 💾 Base de Datos Requerida

```sql
CREATE TABLE "Alumnos" (
  "Id" SERIAL PRIMARY KEY,
  "Cedula" VARCHAR(20) NOT NULL UNIQUE,
  "Nombres" VARCHAR(100) NOT NULL,
  "Apellidos" VARCHAR(100) NOT NULL,
  "Correo" VARCHAR(100) NOT NULL,
  "Telefono" VARCHAR(20),
  "FechaNacimiento" DATE,
  "CarreraId" INTEGER NOT NULL,
  FOREIGN KEY ("CarreraId") REFERENCES "Carreras"("Id")
);

CREATE TABLE "Carreras" (
  "Id" SERIAL PRIMARY KEY,
  "Nombre" VARCHAR(100) NOT NULL
);
```

---

## 🚀 Funciones Clave del Controlador

### Registrar Alumno
```php
AlumnoControlador::procesarRegistro();
// Valida datos, muestra mensaje y redirige al formulario
```

### Consultar Todos
```php
AlumnoControlador::obtenerTodos();
// Retorna array de todos los alumnos
```

### Obtener por ID
```php
AlumnoControlador::obtenerPorId($id);
// Retorna objeto Alumno específico
```

### Actualizar
```php
AlumnoControlador::procesarActualizacion();
// Valida y actualiza datos
```

### Eliminar
```php
AlumnoControlador::eliminar($id);
// Elimina alumno de la BD
```

---

## 📞 Soporte

Revisar archivo `CAMBIOS_REALIZADOS.md` para documentación detallada de cambios.
