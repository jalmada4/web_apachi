<?php
include 'db.php';

$resultado = $conn->query("SELECT id, titulo, fecha, categorias FROM noticias ORDER BY fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - Noticias Apachin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/favicon_apachi.ico">

</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Panel de Administración - Noticias Apachin</h1>

    <a href="crear_noticia.php" class="btn btn-success mb-3">+ Agregar nueva noticia</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Fecha</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $resultado->fetch_assoc()) : ?>
                <tr>
                    <td><?= $fila['id'] ?></td>
                    <td><?= htmlspecialchars($fila['titulo']) ?></td>
                    <td><?= date('d/m/Y', strtotime($fila['fecha'])) ?></td>
                    <td><?= htmlspecialchars($fila['categorias']) ?></td>
                    <td>
                        <a href="editar_noticia.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="eliminar_noticia.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta noticia?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
