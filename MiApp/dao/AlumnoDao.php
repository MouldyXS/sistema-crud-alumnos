<?php
require_once __DIR__ . '/../bd/conexion.php';
require_once __DIR__ . '/../modelo/Alumno.php';

class AlumnoDAO {
    public function registrar($alumno) {
        $pdo = Conexion::conectar();
        $sqlInsert = 'INSERT INTO alumnos (cedula, nombres, apellidos, correo, telefono, fecha_nacimiento, carrera_id)
                      VALUES (:cedula, :nombres, :apellidos, :correo, :telefono, :fechaNacimiento, :carreraId)';
        $stmt = $pdo->prepare($sqlInsert);
        
        return $stmt->execute([
            ':cedula' => $alumno->cedula,
            ':nombres' => $alumno->nombre,
            ':apellidos' => $alumno->apellido,
            ':correo' => $alumno->correo,
            ':telefono' => $alumno->telefono,
            ':fechaNacimiento' => $alumno->fechaNacimiento,
            ':carreraId' => $alumno->carreraId
        ]);
    }

    public function listarTodos() {
        $pdo = Conexion::conectar();
        $sql = 'SELECT id as Id, cedula as Cedula, nombres as Nombres, apellidos as Apellidos, correo as Correo, telefono as Telefono, fecha_nacimiento as FechaNacimiento FROM alumnos ORDER BY id';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT * FROM alumnos WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $alumno = new Alumno();
            $alumno->id = $row['id'];
            $alumno->cedula = $row['cedula'];
            $alumno->nombre = $row['nombres'];
            $alumno->apellido = $row['apellidos'];
            $alumno->correo = $row['correo'];
            $alumno->telefono = $row['telefono'];
            $alumno->fechaNacimiento = $row['fecha_nacimiento'];
            return $alumno;
        }
        return null;
    }

    public function actualizar($alumno) {
        $pdo = Conexion::conectar();
        $sql = 'UPDATE alumnos SET 
                    cedula = :cedula,
                    nombres = :nombre,
                    apellidos = :apellido,
                    correo = :correo,
                    telefono = :telefono,
                    fecha_nacimiento = :fecha
                WHERE id = :id';
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':cedula' => $alumno->cedula,
            ':nombre' => $alumno->nombre,
            ':apellido' => $alumno->apellido,
            ':correo' => $alumno->correo,
            ':telefono' => $alumno->telefono,
            ':fecha' => $alumno->fechaNacimiento,
            ':id' => $alumno->id
        ]);

        return $stmt->rowCount(); 
    }

    public function eliminar($id) {
        $pdo = Conexion::conectar();
        $sql = 'DELETE FROM alumnos WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount(); 
    }
}
?>
?>
