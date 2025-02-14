<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$basePath = "http://localhost:8080";

?>

<nav>
    <ul>
        <li><a href="<?php echo $basePath; ?>/index.php">Inicio</a></li>
        <li><a href="<?php echo $basePath; ?>/views/books.php">Lista de libros</a></li>
        <li><a href="<?php echo $basePath; ?>/views/events.php">Próximos eventos</a></li>
        <li><a href="<?php echo $basePath; ?>/views/contacts.php">Contacto</a></li>
        <?php if ($authInstance->isLoggedIn() && $authInstance->isAdmin()): ?>
            <li><a href="<?php echo $basePath; ?>/views/admin.php">Panel de administración</a></li>
        <?php endif; ?>
    </ul>
</nav>