<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT titulo, cuerpo, copete, fecha, categorias, archivos FROM noticias WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($titulo, $cuerpo, $copete, $fecha, $categoria, $archivo);
        $stmt->fetch();
        $stmt->close();

        // Formatear la fecha en español
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $fechaFormateada = strftime('%e de %B de %Y', strtotime($fecha));
    } else {
        echo "Error en prepare: " . $conn->error;
        exit;
    }
} else {
    echo "ID de noticia no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($titulo); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/favicon_apachi.ico">

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
    <div class="container py-4">
        <h1 class="mb-3"><?php echo $titulo; ?></h1>

        <p><strong>Categoría:</strong> <?php echo $categoria; ?></p>
        <p><strong>Publicado el:</strong> <?php echo $fechaFormateada; ?></p>

        <?php if (!empty($archivo)) : ?>
            <img src="img/<?php echo htmlspecialchars($archivo); ?>" alt="Imagen de la noticia" class="img-fluid mb-4">
        <?php endif; ?>

        <h4><strong>Copete:</strong></h4>
        <div><?php echo $copete; ?></div>

        <h4 class="mt-4"><strong>Contenido completo:</strong></h4>
        <div><?php echo $cuerpo; ?></div>

    </div>

    <!--  Footer -->
<footer class="bg-dark text-white text-center py-4">
  <p class="mb-1">&copy; <?= date('Y') ?> Noticias Apachin</p>
  <a href="index.php" class="btn btn-outline-light btn-sm">← Volver al inicio</a>
</footer>
</body>
</html>
