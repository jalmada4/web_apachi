<?php include 'db.php'; ?>
<?php setlocale(LC_TIME, 'es_ES.UTF-8'); ?>

<?php
$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : null;
$noticias = [];

$categorias_map = [
  'cultura' => 1,
  'economia' => 2,
  'eventos' => 3,
  'politica' => 4,
  'sociales' => 5,
  'Varios' => 6
];

if ($categoriaSeleccionada && isset($categorias_map[$categoriaSeleccionada])) {
  $categoria_id = $categorias_map[$categoriaSeleccionada];
  $stmt = $conn->prepare("SELECT id, titulo, copete, cuerpo, fecha FROM noticias WHERE categorias = ?");
  if ($stmt) {
    $stmt->bind_param("i", $categoria_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    while ($row = $resultado->fetch_assoc()) {
      $noticias[] = $row;
    }
    $stmt->close();
  } else {
    echo "Error en prepare: " . $conn->error;
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Noticias por Categoría</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="icon" type="image/x-icon" href="img/favicon_apachi.ico">
<!--barra de navegacion-->
<style>
  #sidebarMenu {
    width: 250px; /* Podés ajustar este valor a gusto */
  }
</style>

<!--footer-->
  <style>
  html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
  }

  .content-wrapper {
    flex: 1;
  }
</style>

</head>
<body>

<!-- 🔳 Menú superior -->
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
      <i class="bi bi-list"></i> Menú
    </button>
    <span class="navbar-brand mx-auto">Noticias Apachin</span>
  </div>
</nav>

<!-- 🧭 Sidebar offcanvas -->
 <div class="content-wrapper">
<div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sidebarMenuLabel">Menú de Navegación</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column">
      <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house-door"></i> Inicio</a></li>
      <li class="nav-item"><a class="nav-link" href="todas_noticias.php"><i class="bi bi-newspaper"></i> Noticias</a></li>
      <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="conozcanos.php" id="submenuConozcanos" data-bs-toggle="collapse" data-bs-target="#submenuConozcanosItems" aria-expanded="false">
          <i class="bi bi-people"></i> Conózcanos
        </a>
        <div class="collapse ps-3" id="submenuConozcanosItems">
          <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="estatuto.php">Estatuto APACHI</a></li>
            <li class="nav-item"><a class="nav-link" href="comision.php">Comisión Directiva</a></li>
            <li class="nav-item"><a class="nav-link" href="visitantes.php">Visitantes de la República Popular de China</a></li>
            <li class="nav-item"><a class="nav-link" href="comision_militares.php">Comisión de Oficiales en Retiro</a></li>
            <li class="nav-item"><a class="nav-link" href="comision_empresarios.php">Comisión de Empresarios</a></li>
            <li class="nav-item"><a class="nav-link" href="comision_cultura.php">Comisión de Cultura</a></li>
            <li class="nav-item"><a class="nav-link" href="asociados.php">Asociados</a></li>
            <li class="nav-item"><a class="nav-link" href="comision_jovenes.php">Comisión de Jóvenes</a></li>
            <li class="nav-item"><a class="nav-link" href="curriculum.php">Currículum Diógenes Martínez</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item"><a class="nav-link fw-bold text-primary" href="noticias_por_categoria.php"><i class="bi bi-tags"></i> Categorías</a></li>
      <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-envelope"></i> Contacto</a></li>
    </ul>
  </div>
</div>

<!-- ✅ Contenido de Categorías -->
<div class="container mt-4">
  <h1 class="mb-4">Noticias por Categoría</h1>

  <div class="nav-scroller py-1 mb-4 border-bottom">
    <nav class="nav nav-underline justify-content-between">
      <?php foreach ($categorias_map as $nombre => $id): ?>
        <a class="nav-item nav-link <?= $categoriaSeleccionada === $nombre ? 'fw-bold text-primary' : '' ?>" href="?categoria=<?= $nombre ?>">
          <?= ucfirst($nombre) ?>
        </a>
      <?php endforeach; ?>
    </nav>
  </div>

  <?php if ($categoriaSeleccionada): ?>
    <h3 class="mb-3">Noticias en: <?= ucfirst(htmlspecialchars($categoriaSeleccionada)) ?></h3>
    <div class="row">
      <?php if (count($noticias) > 0): ?>
        <?php foreach ($noticias as $noticia): ?>
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($noticia['titulo']) ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= strftime('%d de %B de %Y', strtotime($noticia['fecha'])) ?></h6>
                <p class="card-text"><strong><?= mb_substr(strip_tags($noticia['copete']), 0, 100) ?>...</strong></p>
                <p class="card-text"><?= mb_substr(strip_tags($noticia['cuerpo']), 0, 150) ?>...</p>
                <a href="noticia.php?id=<?= htmlspecialchars($noticia['id']) ?>" class="btn btn-sm btn-outline-primary">Leer más</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No hay noticias disponibles en esta categoría.</p>
      <?php endif; ?>
    </div>
  <?php endif; ?>

 
</div>
</div>
<!--  Footer -->
<footer class="bg-dark text-white text-center py-4">
  <p class="mb-1">&copy; <?= date('Y') ?> Noticias Apachin</p>
  <a href="index.php" class="btn btn-outline-light btn-sm">← Volver al inicio</a>
</footer>
<!-- 📜 Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
