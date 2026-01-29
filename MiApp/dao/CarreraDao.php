<?php
require_once __DIR__ . '/../bd/conexion.php';
require_once __DIR__ . '/../modelo/Carrera.php';

class CarreraDAO {
  

    public static function listarTodos() {
        $pdo = Conexion::conectar();
        $sql = 'SELECT id as Id, nombre as Nombre FROM carreras ORDER BY id';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

}
?>
