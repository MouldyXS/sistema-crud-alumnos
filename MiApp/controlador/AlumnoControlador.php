<?php
require_once __DIR__ . '/../dao/AlumnoDAO.php';
require_once __DIR__ . '/../modelo/Alumno.php';
require_once __DIR__ . '/../dao/CarreraDao.php';



class AlumnoControlador {
   public static function guardar($cedula, $nombres, $apellidos, $correo, $telefono, $fechaNacimiento) {
        $alumno = new Alumno();
        $alumno->cedula = $cedula;
        $alumno->nombre = $nombres;
        $alumno->apellido = $apellidos;
        $alumno->correo = $correo;
        $alumno->telefono = $telefono;
        $alumno->fechaNacimiento = $fechaNacimiento;

        $dao = new AlumnoDAO();
        return $dao->registrar($alumno);
    }


    public static function obtenerTodos() {
        $dao = new AlumnoDAO();
        return $dao->listarTodos();
    }


    public static function procesarRegistro() {
        // Validar que los campos requeridos estén presentes
        $camposRequeridos = ['cedula', 'nombres', 'apellidos', 'correo', 'telefono', 'fechaNacimiento', 'carrera_id'];
        
        foreach ($camposRequeridos as $campo) {
            if (empty($_POST[$campo])) {
                $_SESSION['mensaje'] = 'error';
                $_SESSION['mensaje_texto'] = 'Todos los campos son requeridos.';
                header("Location: index.php?accion=registrarAlumno");
                exit;
            }
        }

        $alumno = new Alumno();
        $alumno->cedula = trim($_POST['cedula']);
        $alumno->nombre = trim($_POST['nombres']);
        $alumno->apellido = trim($_POST['apellidos']);
        $alumno->correo = trim($_POST['correo']);
        $alumno->telefono = trim($_POST['telefono']);
        $alumno->fechaNacimiento = $_POST['fechaNacimiento'];
        $alumno->carreraId = $_POST['carrera_id'];

        // Validar formato de email
        if (!filter_var($alumno->correo, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['mensaje'] = 'error';
            $_SESSION['mensaje_texto'] = 'El correo electrónico no es válido.';
            header("Location: index.php?accion=registrarAlumno");
            exit;
        }

        $dao = new AlumnoDAO();
        if ($dao->registrar($alumno)) {
            $_SESSION['mensaje'] = 'exito';
            $_SESSION['mensaje_texto'] = 'Alumno registrado correctamente.';
            header("Location: index.php?accion=registrarAlumno");
        } else {
            $_SESSION['mensaje'] = 'error';
            $_SESSION['mensaje_texto'] = 'Error al registrar el alumno. Intente nuevamente.';
            header("Location: index.php?accion=registrarAlumno");
        }
        exit;
    }

    public static function obtenerPorId($id) {
        $dao = new AlumnoDAO();
        return $dao->buscarPorId($id);
    }

    public static function procesarActualizacion() {
        $alumno = new Alumno();
        $alumno->id = $_POST['id'];
        $alumno->cedula = $_POST['cedula'];
        $alumno->nombre = $_POST['nombres'];
        $alumno->apellido = $_POST['apellidos'];
        $alumno->correo = $_POST['correo'];
        $alumno->telefono = $_POST['telefono'];
        $alumno->fechaNacimiento = $_POST['fechaNacimiento'];

        $dao = new AlumnoDAO();

        $filasAfectadas= $dao->actualizar($alumno);

        if ($filasAfectadas > 0) {
            header("Location: index.php?accion=consultarAlumnos&mensaje=actualizado");
        } else {
            header("Location: index.php?accion=consultarAlumnos&mensaje=sin_cambios");
        }
        exit;
    }

    public static function eliminar($id) {
        $dao = new AlumnoDAO();
        $filasAfectadas = $dao->eliminar($id);

        if ($filasAfectadas > 0) {
            header("Location: index.php?accion=consultarAlumnos&mensaje=eliminado");
        } else {
            header("Location: index.php?accion=consultarAlumnos&mensaje=error");
        }
        exit;
    }


    public static function obtenerCarreras() {
        return CarreraDao::listarTodos();
    }




}
?>
