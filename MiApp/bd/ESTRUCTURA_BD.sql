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

