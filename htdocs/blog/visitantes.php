<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Estatuto APACHI - Noticias Apachin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="icon" href="img/favicon_apachi.ico">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="btn btn-outline-light" href="conozcanos.php"><i class="bi bi-arrow-left"></i> Volver</a>
    <span class="navbar-brand mx-auto">Noticias Apachin</span>
  </div>
</nav>

<div class="container my-5">
  <h1 class="mb-4 text-center">Visitantes de la República Popular de China</h1>

  <div class="border rounded p-4 bg-light" style="max-height: 80vh; overflow-y: auto;">
    <pre style="white-space: pre-wrap; font-size: 0.95rem;">
<?php
echo htmlspecialchars(file_get_contents("visitantes.txt"));
?>
    </pre>
  </div>
</div>

<footer class="bg-dark text-white text-center py-4">
  <p class="mb-1">&copy; <?= date('Y') ?> Noticias Apachin</p>
  <a href="index.php" class="btn btn-outline-light btn-sm">← Volver al inicio</a>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
