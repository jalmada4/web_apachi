<?php include 'db.php'; ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Todas las noticias</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Todas las noticias</h1>


<!-- 🧭 Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="noticias_por_categoria.php">Categorías</a></li>
        </ol>
    </nav>

    <!-- 🔍 Formulario de búsqueda -->
    <form method="GET" class="mb-4">
      <div class="input-group">
        <input type="text" class="form-control" name="buscar" placeholder="Buscar por título, copete, fecha o categoría..." value="<?= htmlspecialchars($_GET['buscar'] ?? '') ?>">
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
      </div>
    </form>

    <div class="row">
      <?php
        $buscar = $conn->real_escape_string($_GET['buscar'] ?? '');

        // Consulta con múltiples condiciones
        $query = "SELECT id, titulo, copete, fecha, categorias FROM noticias";
        if ($buscar !== '') {
          $query .= " WHERE 
            titulo LIKE '%$buscar%' OR 
            copete LIKE '%$buscar%' OR 
            fecha LIKE '%$buscar%' OR 
            categorias LIKE '%$buscar%'";
        }
        $query .= " ORDER BY fecha DESC";

        $result = $conn->query($query);
        if ($result && $result->num_rows > 0):
          while ($row = $result->fetch_assoc()):
      ?>
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['titulo']) ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?= date("d/m/Y", strtotime($row['fecha'])) ?> - <?= htmlspecialchars($row['categorias']) ?></h6>
            <p class="card-text"><?= mb_substr(strip_tags($row['copete']), 0, 100) ?>...</p>
            <a href="noticia.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">Leer más</a>
          </div>
        </div>
      </div>
      <?php endwhile; else: ?>
        <p class="text-center text-muted">No se encontraron noticias con ese criterio.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
