<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $copete = $_POST['copete'];
    $cuerpo = $_POST['cuerpo'];
    $fecha = $_POST['fecha'];
    $categoria = $_POST['categorias'];

    $stmt = $conn->prepare("UPDATE noticias SET titulo=?, copete=?, cuerpo=?, fecha=?, categorias=? WHERE id=?");
    if ($stmt) {
        $stmt->bind_param("sssssi", $titulo, $copete, $cuerpo, $fecha, $categoria, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php"); // Redirige al inicio
        exit;
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
} else {
    echo "Solicitud no válida.";
}
?>
