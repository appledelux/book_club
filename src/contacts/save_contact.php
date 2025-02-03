<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    filename:
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';


    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
        exit();
    }

    $file = '../data/contacts.json';
    $events = [];

    if (file_exists($file)) {
        $jsonData = file_get_contents($file);
        $contacts = json_decode($jsonData, true) ?? [];
    }

    $newContact = [
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "message" => $_POST["message"]
    ];

    $contacts[] = $newContact;

    if (file_put_contents($file, json_encode($contacts, JSON_PRETTY_PRINT))) {
        echo json_encode(["success" => true, "contacts" => $contacts]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al guardar el contacto."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}
?>