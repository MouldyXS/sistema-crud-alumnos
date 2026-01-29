<?php
require_once __DIR__ . '/../../controlador/AlumnoControlador.php';
// Paginación
$registrosPorPagina = 8;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($paginaActual - 1) * $registrosPorPagina;

// Obtener todos los alumnos
$todos = AlumnoControlador::obtenerTodos();
$totalAlumnos = count($todos);

// Cortar el array para esta página
$alumnos = array_slice($todos, $inicio, $registrosPorPagina);

// Calcular número total de páginas
$totalPaginas = ceil($totalAlumnos / $registrosPorPagina);

include __DIR__ . '/../layout/header.php';
?>

<div class="container mt-4">
   
    <div class="d-flex justify-content-between align-items-center mb-4">
       
        <a href="index.php?accion=menu" class="btn btn-secondary mb-3">← Volver al Menú</a>
        <a href="index.php?accion=registrarAlumno" class="btn btn-success mb-3">
            <i class="bi bi-plus-lg"></i> Nuevo Alumno
        </a>
    </div>

    <h3 class="mb-4"><i class="bi bi-person-lines-fill"></i> Listado de Alumnos</h3>

    <?php
        $mensajes = [
            'actualizado' => ['Alumno actualizado correctamente.', 'success', 'bi-check-circle'],
            'sin_cambios' => ['No se realizaron cambios en el registro.', 'warning', 'bi-exclamation-triangle'],
            'eliminado' => ['Alumno eliminado correctamente.', 'success', 'bi-check-circle'],
            'error' => ['Ocurrió un error al eliminar el alumno.', 'danger', 'bi-exclamation-circle'],
        ];

        if (isset($_GET['mensaje'], $mensajes[$_GET['mensaje']])) {
            [$texto, $tipo, $icono] = $mensajes[$_GET['mensaje']];
    ?>
            <div class="alert alert-<?= $tipo ?> alert-dismissible fade show" role="alert">
                <i class="bi <?= $icono ?>"></i>
                <strong><?= ucfirst(str_replace('_', ' ', $_GET['mensaje'])) ?></strong>
                <?= htmlspecialchars($texto) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
    <?php
        }
    ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th><i class="bi bi-hash"></i> ID</th>
                    <th><i class="bi bi-card-text"></i> Cédula</th>
                    <th><i class="bi bi-person"></i> Nombres</th>
                    <th><i class="bi bi-person"></i> Apellidos</th>
                    <th><i class="bi bi-envelope"></i> Correo</th>
                    <th class="text-center"><i class="bi bi-sliders"></i> Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($alumnos) > 0): ?>
                    <?php foreach ($alumnos as $a): ?>
                        <tr>
                            <td><span class="badge bg-primary"><?= htmlspecialchars($a['Id']) ?></span></td>
                            <td><?= htmlspecialchars($a['Cedula']) ?></td>
                            <td><strong><?= htmlspecialchars($a['Nombres']) ?></strong></td>
                            <td><?= htmlspecialchars($a['Apellidos']) ?></td>
                            <td><small><?= htmlspecialchars($a['Correo']) ?></small></td>
                            
                            <td class="text-center">
                                <button 
                                    class="btn btn-sm btn-info btn-ver" 
                                    data-id="<?= htmlspecialchars($a['Id']) ?>"
                                    data-cedula="<?= htmlspecialchars($a['Cedula']) ?>"
                                    data-nombres="<?= htmlspecialchars($a['Nombres']) ?>"
                                    data-apellidos="<?= htmlspecialchars($a['Apellidos']) ?>"
                                    data-correo="<?= htmlspecialchars($a['Correo']) ?>"
                                    data-telefono="<?= htmlspecialchars($a['Telefono']) ?>"
                                    data-fecha="<?= htmlspecialchars($a['FechaNacimiento']) ?>"
                                    title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                </button>

                                <a href="index.php?accion=editarAlumno&id=<?= htmlspecialchars($a['Id']) ?>" 
                                   class="btn btn-sm btn-warning" 
                                   title="Editar alumno">
                                     <i class="bi bi-pencil-square"></i>
                                </a> 
                                
                                <a href="index.php?accion=eliminarAlumno&id=<?= htmlspecialchars($a['Id']) ?>"
                                    class="btn btn-sm btn-danger"
                                    title="Eliminar alumno"
                                    onclick="return confirm('¿Estás seguro de eliminar este alumno?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="bi bi-inbox"></i> No hay alumnos registrados.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPaginas > 1): ?>
        <nav aria-label="Paginación">
            <ul class="pagination justify-content-center">
                <?php if ($paginaActual > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?accion=consultarAlumnos&pagina=1">
                            <i class="bi bi-chevron-double-left"></i> Primera
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?accion=consultarAlumnos&pagina=<?= $paginaActual - 1 ?>">
                            <i class="bi bi-chevron-left"></i> Anterior
                        </a>
                    </li>
                <?php endif; ?>

                <?php 
                    // Mostrar máximo 5 números de página
                    $inicio_paginacion = max(1, $paginaActual - 2);
                    $fin_paginacion = min($totalPaginas, $paginaActual + 2);
                    
                    for ($i = $inicio_paginacion; $i <= $fin_paginacion; $i++):
                ?>
                    <li class="page-item <?= ($i == $paginaActual) ? 'active' : '' ?>">
                        <a class="page-link" href="?accion=consultarAlumnos&pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($paginaActual < $totalPaginas): ?>
                    <li class="page-item">
                        <a class="page-link" href="?accion=consultarAlumnos&pagina=<?= $paginaActual + 1 ?>">
                            Siguiente <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?accion=consultarAlumnos&pagina=<?= $totalPaginas ?>">
                            Última <i class="bi bi-chevron-double-right"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        
        <div class="text-center text-muted mb-3">
            <small>Mostrando <?= count($alumnos) ?> de <?= $totalAlumnos ?> alumnos | Página <?= $paginaActual ?> de <?= $totalPaginas ?></small>
        </div>
    <?php endif; ?>

</div>

<!-- Modal Ver Alumno -->
<div class="modal fade" id="verAlumnoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title"><i class="bi bi-person-check"></i> Detalles del Alumno</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
            <div class="col-sm-5"><strong>Cédula:</strong></div>
            <div class="col-sm-7"><span id="modal-cedula" class="text-break"></span></div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-5"><strong>Nombres:</strong></div>
            <div class="col-sm-7"><span id="modal-nombres" class="text-break"></span></div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-5"><strong>Apellidos:</strong></div>
            <div class="col-sm-7"><span id="modal-apellidos" class="text-break"></span></div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-5"><strong>Correo:</strong></div>
            <div class="col-sm-7"><span id="modal-correo" class="text-break"></span></div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-5"><strong>Teléfono:</strong></div>
            <div class="col-sm-7"><span id="modal-telefono" class="text-break"></span></div>
        </div>
        <div class="row">
            <div class="col-sm-5"><strong>Fecha de Nacimiento:</strong></div>
            <div class="col-sm-7"><span id="modal-fecha" class="text-break"></span></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<?php include __DIR__ . '/../layout/footer.php'; ?>
