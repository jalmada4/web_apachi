<?php
include 'db.php';
setlocale(LC_TIME, 'es_ES.UTF-8');

$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : null;
$noticias = [];

// Mapeo de nombre => ID
$categorias_map = [
    'cultura' => 1,
    'economia' => 2,
    'eventos' => 3,
    'politica' => 4,
    'sociales' => 5,
    'sin_categoria' => 6
];

if ($categoriaSeleccionada && isset($categorias_map[$categoriaSeleccionada])) {
    $categoria_id = $categorias_map[$categoriaSeleccionada];

    $stmt = $conn->prepare("SELECT id, titulo, copete, cuerpo, fecha FROM noticias WHERE categorias = ?");
    if ($stmt) {
        $stmt->bind_param("i", $categoria_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($row = $resultado->fetch_assoc()) {
            if ($row) {
                $noticias[] = $row;
            }
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
  <link rel="icon" type="image/x-icon" href="img/favicon_apachi.ico">
</head>
<body>
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
          <?php if (is_array($noticia)): ?>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($noticia['titulo']) ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?= strftime('%d de %B de %Y', strtotime($noticia['fecha'])) ?></h6>
                  <p class="card-text"><strong><?= mb_substr(strip_tags($noticia['copete']), 0, 100) ?>...</strong></p>
                  <p class="card-text"><?= mb_substr(strip_tags($noticia['cuerpo']), 0, 150) ?>...</p>
                  <a href="noticia.php?id=<?= htmlspecialchars($noticia['id']) ?>" class="btn btn-sm btn-outline-primary">Leer más</a>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No hay noticias para esta categoría.</p>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <a href="index.php" class="btn btn-secondary mt-4">Volver al inicio</a>
</div>
</body>
</html>
