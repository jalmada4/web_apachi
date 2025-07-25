<?php include 'db.php';
setlocale(LC_TIME, 'es_ES.UTF-8');
 ?>
 <?php
// Última noticia destacada
$destacada_sql = "SELECT n.id, n.titulo, n.copete, n.archivos, c.nombre AS categoria_nombre
                  FROM noticias n
                  LEFT JOIN categorias c ON n.categorias = c.id
                  ORDER BY n.fecha DESC
                  LIMIT 1";
$destacada_result = $conn->query($destacada_sql);
$noticia_destacada = $destacada_result->fetch_assoc();
 ?>


 
 <?php
 //noticias por categoria
include 'db.php';
setlocale(LC_TIME, 'es_ES.UTF-8');
$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : null;

if ($categoriaSeleccionada) {
    $stmt = $conn->prepare("SELECT n.id, n.copete, n.cuerpo, n.fecha, n.vista, c.nombre AS categoria_nombre, c.color
                            FROM noticias n
                            LEFT JOIN categorias c ON n.categorias = c.id
                            WHERE c.nombre = ?
                            ORDER BY n.fecha DESC
                            LIMIT 6");
    $stmt->bind_param("s", $categoriaSeleccionada);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $query = "SELECT n.id, n.copete, n.cuerpo, n.fecha, n.vista, c.nombre AS categoria_nombre, c.color 
              FROM noticias n
              LEFT JOIN categorias c ON n.categorias = c.id
              ORDER BY n.fecha DESC
              LIMIT 6";
    $result = $conn->query($query);
}

?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Noticias Apachin</title>
    <link rel="icon" type="image/x-icon" href="img/favicon_apachi.ico">


    <!-- Bootstrap + CSS personalizado -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="blog.css" rel="stylesheet">
  </head>
  <body>
    <?php
          $query = "SELECT n.id, n.copete, n.cuerpo, n.fecha, n.vista, c.nombre AS categoria_nombre, c.color 
                    FROM noticias n
                    LEFT JOIN categorias c ON n.categorias = c.id
                    ORDER BY n.fecha DESC
                    LIMIT 6"; // por ejemplo, 6 noticias

          $result = $conn->query($query);
      ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Blog Template · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/blog/">

    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }

      .fondo-logo {
        background-image: url('img/china.webp');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        padding: 50px 0; /* ajusta altura del header */
      }


    </style>

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">

    <!-- Script para selector de temas Bootstrap 5.3 (color-modes.js embebido) -->
<script>
(() => {
  'use strict'

  const storedTheme = localStorage.getItem('theme')

  const getPreferredTheme = () => {
    if (storedTheme) {
      return storedTheme
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
  }

  const setTheme = function (theme) {
    if (theme === 'auto') {
      document.documentElement.removeAttribute('data-bs-theme')
    } else {
      document.documentElement.setAttribute('data-bs-theme', theme)
    }
  }

  setTheme(getPreferredTheme())

  window.addEventListener('DOMContentLoaded', () => {
    const el = document.querySelector('#bd-theme')

    if (!el) return

    const themeItems = document.querySelectorAll('[data-bs-theme-value]')

    themeItems.forEach(item => {
      item.addEventListener('click', () => {
        const theme = item.getAttribute('data-bs-theme-value')
        localStorage.setItem('theme', theme)
        setTheme(theme)
      })
    })
  })
})()
</script>

  </head>
  
  <body>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>

    
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="aperture" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
    <circle cx="12" cy="12" r="10"/>
    <path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/>
  </symbol>
  <symbol id="cart" viewBox="0 0 16 16">
    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
  <symbol id="chevron-right" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
  </symbol>
</svg>

<div class="container">
 <header class="border-bottom lh-10 py-10 fondo-logo">
  <div class="row flex-nowrap justify-content-between align-items-center">
    <div class="col-4 pt-5">
      <a class="link-dark" href="#">Suscribirse</a>
    </div>
    <div class="col-4 text-center">
        <a class="blog-header-logo text-body-emphasis text-decoration-none d-block" href="#">APACHI</a>
        <small class="text-body-emphasis">Asociación Paraguay China</small>
    </div>
      

    <div class="col-4 d-flex justify-content-end align-items-center pt-5">
      
      <a class="link-dark" href="#" aria-label="Search">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
      </a>
      <a class="btn btn-sm btn-dark mb-1" href="#">Iniciar Sesión</a>
    </div>
  </div>
</header>
</div>
<!--barra de navegación-->
<div>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">




  <div class="container my-5">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom overflow-hidden text-center bg-body-tertiary border rounded-3">
        <li class="breadcrumb-item">
          <a class="link-body-emphasis fw-semibold text-decoration-none" href="index.php">
            <i class="bi bi-house-door-fill"></i>
            Inicio
          </a>
        </li>
        <li class="breadcrumb-item">
          <a class="link-body-emphasis fw-semibold text-decoration-none" href="noticias_por_categoria.php">Categorias</a>
        </li>
        <li class="breadcrumb-item">
          <a class="link-body-emphasis fw-semibold text-decoration-none" href="conozcanos.php">Conozcanos</a>
        </li>
      </ol>
    </nav>
  </div>
</div>

      <!-- 🔍 Formulario de búsqueda
   <form method="GET" class="mb-4">
      <div class="input-group">
        <input type="text" class="form-control" name="buscar" placeholder="Buscar por título, copete, fecha o categoría..." value="<?= htmlspecialchars($_GET['buscar'] ?? '') ?>">
        <button class="btn btn-sm btn-dark" type="submit">Buscar</button>
      </div>
    </form>  -->

<!--sidebar menu- barra lateral-->



<main class="container">
<?php if ($noticia_destacada): ?>
  <div class="p-4 p-md-5 mb-4 rounded text-white bg-dark position-relative" 
       style="background-image: url('img/<?= htmlspecialchars($noticia_destacada['archivos']) ?>'); 
              background-size: cover; 
              background-position: center; 
              background-repeat: no-repeat; 
              min-height: 300px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(203, 26, 26, 0.5); z-index: 1;"></div>
    <div class="col-lg-6 px-0 position-relative" style="z-index: 2;">
      <h1 class="display-4 fst-italic"><?= htmlspecialchars($noticia_destacada['categoria_nombre']) ?></h1>
      <h2 class="mb-2"><?= htmlspecialchars($noticia_destacada['titulo']) ?></h2>
      <p class="lead my-3"><?= mb_substr(strip_tags(html_entity_decode($noticia_destacada['copete'])), 0, 100) ?>...</p>
      <p class="lead mb-0">
        <a href="noticia.php?id=<?= $noticia_destacada['id'] ?>" class="btn btn-light">Seguir leyendo...</a>
      </p>
    </div>
  </div>
<?php endif; ?>



  <?php if ($categoriaSeleccionada): ?>
  <h2 class="mb-4">Noticias de categoría: <strong><?= htmlspecialchars($categoriaSeleccionada) ?></strong></h2>
<?php endif; ?>


  <div class="row mb-2">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary-emphasis"><?= htmlspecialchars($row['categoria_nombre']) ?></strong>
            <h3 class="mb-0"><?= mb_substr(html_entity_decode(strip_tags($row['copete'])), 0, 40) ?>...</h3>
            <div class="mb-1 text-body-secondary">      <div class="mb-1 text-body-secondary"><?= date("j \d\e F \d\e Y", strtotime($row['fecha'])) ?></div></div>
            <p class="card-text mb-auto"><?= mb_substr(html_entity_decode(strip_tags($row['cuerpo'])), 0, 100) ?>...</p>
            <a href="noticia.php?id=<?= $row['id'] ?>" class="icon-link gap-1 icon-link-hover stretched-link">
              Seguir leyendo
              <svg class="bi"><use xlink:href="#chevron-right"/></svg>
            </a>
          </div>
        </div>
      </div>

    <?php endwhile; ?>
  </div>
    <div class="text-center my-4">
      <a href="todas_noticias.php" class="btn btn-primary d-inline-flex align-items-center">
        Ver todas las noticias
        <svg class="bi ms-1" width="20" height="20">
          <use xlink:href="#arrow-right-short"/>
        </svg>
      </a>
    </div>



  <div class="row g-5">
    
    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <div class="p-4">
          <h4 class="fst-italic">Archives</h4>
          <ol class="list-unstyled mb-0">
            <li><a href="#">March 2021</a></li>
            <li><a href="#">February 2021</a></li>
            <li><a href="#">January 2021</a></li>
            <li><a href="#">December 2020</a></li>
            <li><a href="#">November 2020</a></li>
            <li><a href="#">October 2020</a></li>
            <li><a href="#">September 2020</a></li>
            <li><a href="#">August 2020</a></li>
            <li><a href="#">July 2020</a></li>
            <li><a href="#">June 2020</a></li>
            <li><a href="#">May 2020</a></li>
            <li><a href="#">April 2020</a></li>
          </ol>
        </div>  
      </div>
    </div>
  </div>

</main>

<!--  Footer -->
<footer class="bg-dark text-white text-center py-4">
  <p class="mb-1">&copy; <?= date('Y') ?> Noticias Apachin</p>
  <a href="index.php" class="btn btn-outline-light btn-sm">← Volver al inicio</a>
</footer>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>

