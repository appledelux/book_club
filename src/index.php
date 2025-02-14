<?php
require_once __DIR__ . '/controllers/authController.php';

$authInstance = new Auth();
$isLoggedIn = $authInstance->isLoggedIn();

if (!$isLoggedIn) {
  header(header: "Location: ../views/login.php");
  exit();
}

if (isset($_GET['logout'])) {
  $authInstance->logout();
  header("Location: index.php");
  exit();
}

$username = $_SESSION['username'] ?? 'user';

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Club de Lectura</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Poppins:wght@300;400;500&display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="/styles/panel.css">
  <link rel="stylesheet" href="/styles/views.css">
  <link rel="stylesheet" href="/styles/book_form.css">
  <link rel="stylesheet" href="/styles/event_form.css">
  <link rel="stylesheet" href="/styles/review_form.css">
  <script>
    function showSection(sectionId) {
      const container = document.getElementById("mainContainer");
      container.innerHTML = `<h2>Cargando...</h2>`;

      fetch(`/routes/load_section.php?section=${sectionId}`)
        .then(response => response.text())
        .then(html => {
          container.innerHTML = html;

          const scriptLoader = container.querySelector("#script-loader");
          if (scriptLoader) {
            const scriptSrc = scriptLoader.getAttribute("data-script");

            if (!document.querySelector(`script[src='${scriptSrc}']`)) {
              const scriptElement = document.createElement("script");
              scriptElement.src = scriptSrc;
              document.body.appendChild(scriptElement);
            }

            scriptLoader.remove();
          }
        })
        .catch(error => {
          console.error("Error al cargar la sección:", error);
          container.innerHTML = `<p style="color: red;">Error al cargar la sección.</p>`;
        });
    }
    function logout() {
      window.location.href = "?logout=true";
    }
  </script>
</head>

<body>
  <div class="sidebar">
    <h2>Panel de
      <?php echo (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) ? 'Administración' : 'Usuario'; ?>
    </h2>
    <ul>
      <li onclick="showSection('viewBooks')">Visualizar Libros</li>
      <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
        <li onclick="showSection('createBook')">Crear Libro</li>
      <?php endif; ?>
      <li onclick="showSection('viewEvents')">Visualizar Eventos</li>
      <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
        <li onclick="showSection('createEvent')">Crear Evento</li>
      <?php endif; ?>
      <li onclick="showSection('viewReviews')">Visualizar Reseñas</li>
      <li onclick="showSection('createReview')">Crear Reseña</li>
    </ul>
    <div class="logout">
      <button class="logout-btn" onclick="logout()">Cerrar Sesión</button>
    </div>
  </div>

  <div class="content-user" id="mainContainer">
    <h1>Hola <?php echo htmlspecialchars($username); ?>, Bienvenido al Club de Lectura, </h1>
    <img src="assets/club_lectura.webp" alt="Club de Lectura" width="300px" height="200px">
    <p>Comparte tu pasión por la lectura con otros lectores. ¿A qué estás esperando?</p>
    <hr>
  </div>
</body>

</html>