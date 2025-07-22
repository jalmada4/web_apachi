<?php
$host = "localhost";
$user = "root"; // Cambiá si tenés otro usuario
$pass = "";     // Cambiá si tenés contraseña
$dbname = "apachin_noticias";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
  die("❌ Conexión fallida: " . $conn->connect_error);
}

echo "✅ Conexión exitosa a la base de datos";
$conn->close();
?>
