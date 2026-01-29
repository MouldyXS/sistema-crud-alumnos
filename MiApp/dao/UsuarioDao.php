<?php
require_once 'bd/conexion.php';
require_once 'modelo/Usuario.php';

class UsuarioDAO {
    public function autenticar($usuario, $clave) {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND clave = :clave");
        $stmt->execute(['usuario' => $usuario, 'clave' => $clave]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila) {
            $u = new Usuario();
            $u->id = $fila['id'];
            $u->usuario = $fila['usuario'];
            return $u;
        }
        return null;
    }

    public function existeUsuario($usuario) {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = :usuario");
        $stmt->execute(['usuario' => $usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    public function registrar($usuario) {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, clave) VALUES (:usuario, :clave)");
        return $stmt->execute([
            ':usuario' => $usuario->usuario,
            ':clave' => $usuario->clave
        ]);
    }
}
?>
