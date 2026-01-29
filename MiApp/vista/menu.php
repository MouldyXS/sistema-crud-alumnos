<?php

include 'layout/header.php';
?>

<div class="container mt-4">

    <!-- Encabezado con título y botón en la misma fila -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0">Menú Principal</h2>
        <a href="../index.php?accion=logout" class="btn btn-danger">Cerrar sesión</a>
    </div>

   <p class="mb-4">
        Bienvenido,
        <strong>
            <?= isset($_SESSION['usuario']) ? strtoupper($_SESSION['usuario']) : 'Usuario' ?>
        </strong>
    </p>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h5 class="card-title">Alumnos</h5>
                    <p class="card-text">Gestión de estudiantes.</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="../index.php?accion=registrarAlumno" class="btn btn-outline-primary btn-sm">Registrar</a>
                        <a href="../index.php?accion=consultarAlumnos" class="btn btn-outline-secondary btn-sm">Consultar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <a href="#" class="text-decoration-none">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Docentes</h5>
                        <p class="card-text">Gestión de profesores.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="#" class="text-decoration-none">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Cursos</h5>
                        <p class="card-text">Gestión de materias o asignaturas.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
