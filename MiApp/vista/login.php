<?php 
include __DIR__ . '/layout/header.php'; 

// Obtener mensajes de sesión
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : null;
$mensajeTexto = isset($_SESSION['mensaje_texto']) ? $_SESSION['mensaje_texto'] : '';

// Limpiar mensajes después de mostrarlos
unset($_SESSION['mensaje']);
unset($_SESSION['mensaje_texto']);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <!-- Imagen/logo opcional -->
            <div class="text-center mb-4">
                <i class="bi bi-shield-lock" style="font-size: 3rem; color: #0d6efd;"></i>
            </div>

            <div class="card shadow">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">Inicio de Sesión</h3>

                    <?php if ($mensaje): ?>
                        <div class="alert alert-<?= ($mensaje === 'exito') ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                            <i class="bi <?= ($mensaje === 'exito') ? 'bi-check-circle' : 'bi-exclamation-circle' ?>"></i>
                            <?= htmlspecialchars($mensajeTexto) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="index.php?accion=procesarLogin">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingrese su usuario" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="clave" class="form-label">Clave:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="clave" id="clave" class="form-control" placeholder="Ingrese su clave" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right"></i> Ingresar
                            </button>
                        </div>
                    </form>

                    <!-- Mensaje de error adicional -->
                    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                        <div class="alert alert-danger mt-3 p-2 text-center">
                            <i class="bi bi-exclamation-circle"></i> Usuario o clave incorrectos.
                        </div>
                    <?php endif; ?>

                    <hr class="my-3">

                    <!-- Opción para registrarse -->
                    <div class="text-center">
                        <p class="mb-0">¿No tienes cuenta?</p>
                        <a href="index.php?accion=registroUsuario" class="btn btn-outline-success btn-sm mt-2">
                            <i class="bi bi-person-plus"></i> Crear Nueva Cuenta
                        </a>
                    </div>

                    <div class="text-center mt-3">
                        <a href="index.php?accion=inicio" class="btn btn-outline-secondary btn-sm">
                            ← Volver al inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
            <br>
        </div>
    </div>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
