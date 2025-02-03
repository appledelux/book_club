<?php
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de administración</title>
</head>

<body>
    <a href="index.php">Volver</a>

    <h1>Panel de Administración</h1>

    <h2>Agregar libro</h2>
    <?php include 'books/book_form.php'; ?>

    <hr>

    <h2>Registrar evento</h2>
    <?php include 'events/event_form.php'; ?>

    <hr>
    <h2>Publicar reseña</h2>
    <?php include 'reviews/review_form.php'; ?>

</body>

</html>