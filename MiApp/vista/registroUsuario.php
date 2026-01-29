<?php 
include __DIR__ . '/layout/header.php'; 

// Obtener mensajes de sesión
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : null;
$mensajeTexto = isset($_SESSION['mensaje_texto']) ? $_SESSION['mensaje_texto'] : '';

// Limpiar mensajes después de mostrarlos
unset($_SESSION['mensaje']);
unset($_SESSION['mensaje_texto']);
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-plus-fill" style="font-size: 2.5rem; color: #198754;"></i>
                    </div>

                    <h3 class="text-center mb-4">Crear Nueva Cuenta</h3>

                    <?php if ($mensaje): ?>
                        <div class="alert alert-<?= ($mensaje === 'exito') ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                            <i class="bi <?= ($mensaje === 'exito') ? 'bi-check-circle' : 'bi-exclamation-circle' ?>"></i>
                            <strong><?= ($mensaje === 'exito') ? '¡Éxito!' : '¡Error!' ?></strong>
                            <?= htmlspecialchars($mensajeTexto) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="index.php?accion=procesarRegistroUsuario">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="usuario" id="usuario" class="form-control" 
                                       placeholder="Mínimo 3 caracteres" required minlength="3">
                            </div>
                            <small class="form-text text-muted">Mínimo 3 caracteres, sin espacios</small>
                        </div>

                        <div class="mb-3">
                            <label for="clave" class="form-label">Clave:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="clave" id="clave" class="form-control" 
                                       placeholder="Mínimo 4 caracteres" required minlength="4">
                            </div>
                            <small class="form-text text-muted">Mínimo 4 caracteres</small>
                        </div>

                        <div class="mb-3">
                            <label for="clave_confirmar" class="form-label">Confirmar Clave:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-check"></i></span>
                                <input type="password" name="clave_confirmar" id="clave_confirmar" class="form-control" 
                                       placeholder="Repite tu clave" required minlength="4">
                            </div>
                            <small class="form-text text-muted">Debe coincidir con la clave anterior</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Crear Cuenta
                            </button>
                        </div>
                    </form>

                    <hr class="my-3">

                    <!-- Opción para volver a login -->
                    <div class="text-center">
                        <p class="mb-0">¿Ya tienes cuenta?</p>
                        <a href="index.php?accion=login" class="btn btn-outline-primary btn-sm mt-2">
                            <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                        </a>
                    </div>

                    <div class="text-center mt-3">
                        <a href="index.php?accion=inicio" class="btn btn-outline-secondary btn-sm">
                            ← Volver al inicio
                        </a>
                    </div>
                </div>
            </div>

            <!-- Información de requisitos -->
            <div class="alert alert-info mt-4" role="alert">
                <h6 class="alert-heading"><i class="bi bi-info-circle"></i> Requisitos de Contraseña</h6>
                <ul class="mb-0">
                    <li>Usuario: mínimo <strong>3 caracteres</strong></li>
                    <li>Clave: mínimo <strong>4 caracteres</strong></li>
                    <li>Las claves deben <strong>coincidir exactamente</strong></li>
                    <li>Evita usar caracteres especiales</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
