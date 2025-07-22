<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT titulo, copete, cuerpo, fecha, categorias FROM noticias WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($titulo, $copete, $cuerpo, $fecha, $categoria);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "ID no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Noticia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/favicon_apachi.ico">

</head>
<body>
<div class="container mt-5">
    <h2>Editar Noticia</h2>
    <form action="actualizar_noticia.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>" required>
        </div>

        <div class="mb-3">
            <label for="copete" class="form-label">Copete</label>
            <textarea class="form-control" name="copete" required><?php echo htmlspecialchars($copete); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="cuerpo" class="form-label">Contenido</label>
            <textarea class="form-control" name="cuerpo" rows="5" required><?php echo htmlspecialchars($cuerpo); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha" value="<?php echo $fecha; ?>" required>
        </div>

        <div class="mb-3">
            <label for="categorias" class="form-label">Categoría</label>
            <input type="text" class="form-control" name="categorias" value="<?php echo htmlspecialchars($categoria); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
