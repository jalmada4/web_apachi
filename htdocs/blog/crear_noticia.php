<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $copete = $_POST['copete'];
    $cuerpo = $_POST['cuerpo'];
    $fecha = $_POST['fecha'];
    $categorias = $_POST['categorias'];
    $archivo = $_FILES['archivo']['name'];

    // Mover archivo a carpeta img/
    if (!empty($archivo)) {
        $destino = "img/" . basename($archivo);
        move_uploaded_file($_FILES['archivo']['tmp_name'], $destino);
    }

    $sql = "INSERT INTO noticias (titulo, copete, cuerpo, fecha, categorias, archivos) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $titulo, $copete, $cuerpo, $fecha, $categorias, $archivo);

    if ($stmt->execute()) {
        header("Location: admin_noticias.php");
        exit;
    } else {
        echo "Error al guardar la noticia: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Nueva Noticia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/favicon_apachi.ico">
</head>
<body>
<div class="container mt-5">
    <h2>Crear Nueva Noticia</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Copete</label>
            <textarea name="copete" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Cuerpo</label>
            <textarea name="cuerpo" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Categoría</label>
            <input type="text" name="categorias" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Imagen (opcional)</label>
            <input type="file" name="archivo" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Guardar Noticia</button>
        <a href="admin_noticias.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
