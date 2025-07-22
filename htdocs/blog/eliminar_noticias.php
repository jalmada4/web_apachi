<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar registro
    $stmt = $conn->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin_noticias.php");
        exit;
    } else {
        echo "Error al eliminar la noticia: " . $conn->error;
    }
} else {
    echo "ID de noticia no especificado.";
}
?>
