<?php
require_once __DIR__ . '/../dao/UsuarioDAO.php';

class UsuarioControlador {
    public static function procesarLogin($usuario, $clave) {
        $dao = new UsuarioDAO();
        $usuarioObj = $dao->autenticar($usuario, $clave);

        if ($usuarioObj) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['usuario'] = $usuarioObj->usuario;
            header("Location: index.php?accion=menu");
        } else {
            header("Location: index.php?accion=login&error=1");
        }
        exit;
    }

    public static function procesarRegistro() {
        // Validar campos requeridos
        if (empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['clave_confirmar'])) {
            $_SESSION['mensaje'] = 'error';
            $_SESSION['mensaje_texto'] = 'Todos los campos son requeridos.';
            header("Location: index.php?accion=registroUsuario");
            exit;
        }

        $usuario = trim($_POST['usuario']);
        $clave = trim($_POST['clave']);
        $clave_confirmar = trim($_POST['clave_confirmar']);

        // Validar longitud de usuario
        if (strlen($usuario) < 3) {
            $_SESSION['mensaje'] = 'error';
            $_SESSION['mensaje_texto'] = 'El usuario debe tener al menos 3 caracteres.';
            header("Location: index.php?accion=registroUsuario");
            exit;
        }

        // Validar longitud de clave
        if (strlen($clave) < 4) {
            $_SESSION['mensaje'] = 'error';
            $_SESSION['mensaje_texto'] = 'La clave debe tener al menos 4 caracteres.';
            header("Location: index.php?accion=registroUsuario");
            exit;
        }

        // Validar que las claves coincidan
        if ($clave !== $clave_confirmar) {
            $_SESSION['mensaje'] = 'error';
            $_SESSION['mensaje_texto'] = 'Las claves no coinciden.';
            header("Location: index.php?accion=registroUsuario");
            exit;
        }

        // Verificar si el usuario ya existe
        $dao = new UsuarioDAO();
        if ($dao->existeUsuario($usuario)) {
            $_SESSION['mensaje'] = 'error';
            $_SESSION['mensaje_texto'] = 'El usuario ya existe. Intente con otro nombre.';
            header("Location: index.php?accion=registroUsuario");
            exit;
        }

        // Crear objeto usuario
        $usuarioObj = new Usuario();
        $usuarioObj->usuario = $usuario;
        $usuarioObj->clave = $clave; // En producción, usar hash

        // Registrar usuario
        if ($dao->registrar($usuarioObj)) {
            $_SESSION['mensaje'] = 'exito';
            $_SESSION['mensaje_texto'] = 'Usuario creado correctamente. Ahora puedes iniciar sesión.';
            header("Location: index.php?accion=login");
            exit;
        } else {
            $_SESSION['mensaje'] = 'error';
            $_SESSION['mensaje_texto'] = 'Error al crear el usuario. Intente nuevamente.';
            header("Location: index.php?accion=registroUsuario");
            exit;
        }
    }

    public static function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: index.php?accion=inicio");
        exit;
    }
}
?>
