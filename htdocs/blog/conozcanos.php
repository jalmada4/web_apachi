<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Conózcanos - Noticias Apachin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="icon" href="img/favicon_apachi.ico">

  <!--barra de navegacion-->
<style>
  #sidebarMenu {
    width: 250px; /* Podés ajustar este valor a gusto */
  }
</style>

</head>
<body>

<!-- Botón de menú sidebar -->
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
      <i class="bi bi-list"></i> Menú
    </button>
    <span class="navbar-brand mx-auto">Noticias Apachin</span>
  </div>
</nav>

<!-- 📚 Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sidebarMenuLabel">Menú de Navegación</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>
  <div class="offcanvas-body">
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link" href="index.php"><i class="bi bi-house-door"></i> Inicio</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="todas_noticias.php"><i class="bi bi-newspaper"></i> Noticias</a>
    </li>

    <!-- 🔽 Ítem desplegable para "Conózcanos" -->
    <li class="nav-item">
      <a class="nav-link dropdown-toggle" href="#" id="submenuConozcanos" data-bs-toggle="collapse" data-bs-target="#submenuConozcanosItems" aria-expanded="false" aria-controls="submenuConozcanosItems">
        <i class="bi bi-people"></i> Conózcanos
      </a>
      <div class="collapse ps-3" id="submenuConozcanosItems">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="estatuto.php">Estatuto APACHI</a>
            </li>

         
          <li class="nav-item">
            <a class="nav-link" href="comision.php">Comisión Directiva</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="visitantes.php">Visitantes de la República Popular de China</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="comision_militares.php">Comisión Coordinadora de los “Oficiales en situación de retiro de las Fuerzas Armadas de la Nación” de la APACHI</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="comision_empresarios.php">Comisión Coordinadora de Empresarios de la APACHI</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="comision_cultura.php">Comisión Coordinadora de Cultura de la APACHI</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="asociados.php">Asociados de la APACHI</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="comision_jovenes.php">Comisión Coordinadora de los Jóvenes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="curriculum.php"> Curriculum Vitae DIOGENES MARTINEZ</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="noticias_por_categoria.php"><i class="bi bi-tags"></i> Categorías</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="bi bi-envelope"></i> Contacto</a>
    </li>
  </ul>
</div>

</div>

<!-- ✅ Contenido principal -->
<div class="container my-5">
  <h1 class="mb-4 text-center">Conózcanos</h1>

  <div class="row align-items-center mb-5">
    <div class="col-md-6">
      <img src="img/paraguaychina.jpg" alt="Equipo Apachin" class="img-fluid rounded shadow-sm">
    </div>
    <div class="col-md-6">
      <h2>Nuestra historia</h2>
      <p>Somos una organización comprometida con fortalecer los lazos culturales, económicos y sociales entre Paraguay y China. A través de Noticias Apachin, compartimos contenido actualizado y relevante para toda la comunidad.</p>
      <p>Desde nuestros inicios, trabajamos para ser un puente informativo confiable que fomente el entendimiento mutuo y el crecimiento conjunto.</p>
    </div>
  </div>

  <div class="row text-center">
    <div class="col-md-4">
      <i class="bi bi-globe2 fs-1 text-primary"></i>
      <h4>Misión</h4>
      <p>Informar con responsabilidad y promover el intercambio cultural y económico.</p>
    </div>
    <div class="col-md-4">
      <i class="bi bi-eye fs-1 text-success"></i>
      <h4>Visión</h4>
      <p>Ser el portal de referencia en la cooperación Paraguay-China.</p>
    </div>
    <div class="col-md-4">
      <i class="bi bi-people fs-1 text-danger"></i>
      <h4>Valores</h4>
      <p>Transparencia, respeto, diversidad y compromiso social.</p>
    </div>
  </div>
</div>

<!--  Footer -->
<footer class="bg-dark text-white text-center py-4">
  <p class="mb-1">&copy; <?= date('Y') ?> Noticias Apachin</p>
  <a href="index.php" class="btn btn-outline-light btn-sm">← Volver al inicio</a>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
