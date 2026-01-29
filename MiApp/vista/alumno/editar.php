<?php 
include __DIR__ . '/../layout/header.php'; 
require_once __DIR__ . '/../../controlador/AlumnoControlador.php';
$carreras = AlumnoControlador::obtenerCarreras();
?>

<div class="container mt-4">
    <a href="index.php?accion=consultarAlumnos" class="btn btn-secondary btn-sm mb-3">← Volver a Consulta</a>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Editar Alumno</h4>

                    <form action="index.php?accion=actualizarAlumno" method="POST">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($alumno->id) ?>">

                        <div class="mb-3">
                            <label class="form-label">Cédula</label>
                            <input type="text" name="cedula" class="form-control" value="<?= htmlspecialchars($alumno->cedula) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombres</label>
                            <input type="text" name="nombres" class="form-control" value="<?= htmlspecialchars($alumno->nombre) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" value="<?= htmlspecialchars($alumno->apellido) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" name="correo" class="form-control" value="<?= htmlspecialchars($alumno->correo) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($alumno->telefono) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input type="date" name="fechaNacimiento" class="form-control" value="<?= htmlspecialchars($alumno->fechaNacimiento) ?>" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Actualizar Alumno
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
