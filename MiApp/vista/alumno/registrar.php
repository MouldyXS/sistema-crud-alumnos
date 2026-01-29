<?php 
include __DIR__ . '/../layout/header.php'; 

//require_once __DIR__ . '/../../controlador/CarreraControlador.php';
//$carreras = CarreraControlador::obtenerTodos();

require_once __DIR__ . '/../../controlador/AlumnoControlador.php';
$carreras = AlumnoControlador::obtenerCarreras();

// Obtener mensajes de sesión
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : null;
$mensajeTexto = isset($_SESSION['mensaje_texto']) ? $_SESSION['mensaje_texto'] : '';

// Limpiar mensajes después de mostrarlos
unset($_SESSION['mensaje']);
unset($_SESSION['mensaje_texto']);

?>

<div class="container mt-4">
    <a href="index.php?accion=menu" class="btn btn-secondary btn-sm mb-3">← Volver al Menú</a>

    <?php if ($mensaje): ?>
        <div class="alert alert-<?= ($mensaje === 'exito') ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
            <i class="bi <?= ($mensaje === 'exito') ? 'bi-check-circle' : 'bi-exclamation-circle' ?>"></i>
            <strong><?= ($mensaje === 'exito') ? '¡Éxito!' : '¡Error!' ?></strong>
            <?= htmlspecialchars($mensajeTexto) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Registrar Alumno</h4>

                    <form action="index.php?accion=guardarAlumno" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Cédula</label>
                            <input type="text" name="cedula" class="form-control" placeholder="Ingrese la cédula" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombres</label>
                            <input type="text" name="nombres" class="form-control" placeholder="Ingrese los nombres" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" placeholder="Ingrese los apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" name="correo" class="form-control" placeholder="Ingrese el correo" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="Ingrese el teléfono" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input type="date" name="fechaNacimiento" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Carrera</label>
                            <select name="carrera_id" class="form-control" required>
                                <option value="">Seleccione una carrera</option>
                                <?php foreach ($carreras as $c): ?>
                                    <option value="<?= htmlspecialchars($c['Id']) ?>"><?= htmlspecialchars($c['Nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Guardar Alumno
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
