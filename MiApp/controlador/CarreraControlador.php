<?php
require_once __DIR__ . '/../dao/CarreraDAO.php';
require_once __DIR__ . '/../modelo/Carrera.php';


class CarreraControlador {
 
    public static function obtenerTodos() {
        $dao = new CarreraDAO();
        return $dao->listarTodos();
    }
   
}
?>
