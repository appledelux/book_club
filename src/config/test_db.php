<?php
require_once 'config/database.php';

$conn = Database::getConnection();

if ($conn) {
  echo "Conexión exitosa a la base de datos.";
} else {
  echo "Error de conexión.";
}