# ⚙️ CONFIGURACIÓN DE BASE DE DATOS

## El error que viste:
```
Error de conexión: could not find driver
```

Esto significa que el sistema estaba configurado para PostgreSQL, pero tu XAMPP tiene MySQL (lo más común).

---

## 📋 Pasos para Configurar la Base de Datos MySQL

### 1️⃣ Abre phpMyAdmin
```
http://localhost/phpmyadmin
```

### 2️⃣ En la pestaña "SQL", copia y pega TODO el código a continuación:

```sql
-- Script de Base de Datos para Sistema de Gestión Académica (MySQL)

-- Crear base de datos
CREATE DATABASE IF NOT EXISTS sistema_academico CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sistema_academico;

-- Tabla de Usuarios (Cuentas de acceso)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    clave VARCHAR(100) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Carreras
CREATE TABLE IF NOT EXISTS carreras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT
);

-- Tabla de Alumnos
CREATE TABLE IF NOT EXISTS alumnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(20) NOT NULL UNIQUE,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    fecha_nacimiento DATE,
    carrera_id INT NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (carrera_id) REFERENCES carreras(id),
    INDEX idx_cedula (cedula),
    INDEX idx_carrera (carrera_id)
);

-- Insertar carreras de ejemplo
INSERT INTO carreras (nombre, descripcion) VALUES 
('Ingeniería en Sistemas', 'Carrera de Ingeniería en Informática y Sistemas Computacionales'),
('Administración de Empresas', 'Carrera de Administración y Gestión Empresarial'),
('Contabilidad', 'Carrera de Contabilidad Pública');

-- Insertar usuarios de prueba
-- usuario: admin, clave: 1234
-- usuario: usuario, clave: 1234
INSERT INTO usuarios (usuario, clave) VALUES 
('admin', '1234'),
('usuario', '1234');
```

### 3️⃣ Haz clic en "Continuar" o "Ejecutar"

### 4️⃣ Verifica que todo se creó correctamente:
- ✓ Base de datos: `sistema_academico`
- ✓ Tablas: `usuarios`, `carreras`, `alumnos`
- ✓ Usuarios de prueba creados

---

## 🔑 Credenciales de Prueba

| Campo | Valor |
|-------|-------|
| **Usuario** | admin |
| **Clave** | 1234 |

O puedes usar:

| Campo | Valor |
|-------|-------|
| **Usuario** | usuario |
| **Clave** | 1234 |

---

## ✅ Después de Crear la BD

1. Actualiza el navegador: `http://localhost:8000`
2. **Haz clic en "Iniciar Sesión"**
3. Usa credenciales: `admin` / `1234`
4. ¡Listo! Ahora puedes registrar alumnos

---

## 🐛 Si aún hay problemas:

### Error: "Base de datos no existe"
→ Verifica que ejecutaste correctamente todo el código SQL

### Error: "UNIQUE constraint failed"
→ Significa que ya existen datos. Puedes:
- Usar otro usuario/cedula
- O eliminar la BD y crearla de nuevo

### El servidor no responde
→ Abre terminal y ejecuta:
```powershell
cd "c:\Users\xaviers salazars\Downloads\U4 S14 Proyecto - Crud Alumnos-20260128\MiApp"
php -S localhost:8000
```

---

## 📁 Archivos Actualizados

- ✅ `bd/conexion.php` → Cambiado a MySQL
- ✅ `dao/AlumnoDao.php` → Consultas MySQL
- ✅ `dao/CarreraDao.php` → Consultas MySQL
- ✅ `bd/ESTRUCTURA_BD.sql` → Script MySQL

¡Listo para funcionar! 🚀
