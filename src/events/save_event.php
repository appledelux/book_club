<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';
    $description = $_POST['description'] ?? '';

    if (empty($title) || empty($date) || empty($description)) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
        exit();
    }

    $file = '../data/events.json';
    $events = [];

    if (file_exists($file)) {
        $jsonData = file_get_contents($file);
        $events = json_decode($jsonData, true) ?? [];
    }

    $newEvent = [
        "title" => $title,
        "date" => $date,
        "description" => $description
    ];

    $events[] = $newEvent;

    if (file_put_contents($file, json_encode($events, JSON_PRETTY_PRINT))) {
        echo json_encode(["success" => true, "events" => $events]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al guardar el evento."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}
?>