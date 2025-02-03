<?php
define("BASE_URL", "http://localhost:8080"); // URL base del proyecto
define("ROOT_PATH", __DIR__); // Ruta absoluta al directorio del proyecto
define("SRC_PATH", ROOT_PATH . "/src"); // Ruta a la carpeta src
define("INCLUDES_PATH", ROOT_PATH . "/includes"); // Ruta a la carpeta includes
define("ASSETS_PATH", BASE_URL . "/assets"); // Ruta a los assets

// Rutas a archivos específicos
define("SAVE_REVIEW", BASE_URL . "/reviews/save_review.php");
define("SAVE_EVENT", BASE_URL . "/events/save_event.php");
define("SAVE_CONTACT", value: BASE_URL . "/contacts/save_contact.php");
define("SAVE_BOOK", value: BASE_URL . "/books/save_book.php");

?>