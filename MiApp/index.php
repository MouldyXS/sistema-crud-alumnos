<?php
// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cargar controladores necesarios
require_once 'controlador/UsuarioControlador.php';
require_once 'controlador/AlumnoControlador.php';

// Obtener acción de la URL (por defecto: 'menu')
$accion = $_GET['accion'] ?? 'inicio';

// Si ya hay sesión activa y va al login o inicio, redirigir al menú
if (isset($_SESSION['usuario']) && in_array($accion, ['login', 'inicio'])) {
    header("Location: index.php?accion=menu");
    exit;
}

// Opcional: proteger acciones que requieren sesión
$accionesProtegidas = ['menu', 'registrarAlumno', 'guardarAlumno', 'consultarAlumnos', 'logout'];
if (in_array($accion, $accionesProtegidas)) {
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php?accion=login");
        exit;
    }
}

// Enrutamiento por acción
switch ($accion) {

    // LOGIN / LOGOUT / REGISTRO USUARIO
    case 'login':
        include 'vista/login.php';
        break;

    case 'registroUsuario':
        include 'vista/registroUsuario.php';
        break;

    case 'procesarLogin':
        UsuarioControlador::procesarLogin($_POST['usuario'], $_POST['clave']);
        break;

    case 'procesarRegistroUsuario':
        UsuarioControlador::procesarRegistro();
        break;

    case 'logout':
        UsuarioControlador::logout();
        break;

    // ALUMNOS
    case 'registrarAlumno':
        
        include 'vista/alumno/registrar.php';
        break;

    case 'guardarAlumno':
        AlumnoControlador::procesarRegistro();
        break;

    case 'consultarAlumnos':
        include 'vista/alumno/consultar.php';
        break;
        
    case 'editarAlumno':
        $alumno = AlumnoControlador::obtenerPorId($_GET['id']);
        include 'vista/alumno/editar.php';
        break;

    case 'actualizarAlumno':
        AlumnoControlador::procesarActualizacion();
        break;

    case 'eliminarAlumno':
    AlumnoControlador::eliminar($_GET['id']);
    break;


    // MENÚ PRINCIPAL
    case 'menu':
        include 'vista/menu.php';
        break;

     
    default:
        include 'vista/inicio.php';
        break;

}
