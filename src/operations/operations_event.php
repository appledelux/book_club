<?php
require_once __DIR__ . '/../controllers/eventController.php';

header('Content-Type: application/json');
$event = new Event();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = json_decode(file_get_contents("php://input"), true);

    $title = trim($input['title'] ?? '');
    $date = $input['date'] ?? '';
    $description = trim($input['description'] ?? '');
    $dateObj = DateTime::createFromFormat('Y-m-d', $date);


    if (empty($title) || !$dateObj || empty($description)) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios y la fecha debe tener el formato correcto (YYYY-MM-DD HH:MM:SS)."]);
        exit;
    }

    $formattedDate = $dateObj->format('Y-m-d H:i:s');


    $response = $event->save($title, $formattedDate, $description);
    echo json_encode($response);
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] === "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);

    $id = filter_var($data['id'] ?? '', FILTER_VALIDATE_INT);
    $title = trim($data['title'] ?? '');
    $date = $data['date'] ?? '';
    $description = trim($data['description'] ?? '');

    $dateObj = DateTime::createFromFormat('Y-m-d H:i:s', $date);

    if (!$id || empty($title) || !$dateObj || empty($description)) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios y la fecha debe tener el formato correcto (YYYY-MM-DD HH:MM:SS)."]);
        exit;
    }

    $response = $event->update($id, $title, $date, $description);
    echo json_encode($response);
    exit;

} else if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);

    $id = filter_var($data['id'] ?? '', FILTER_VALIDATE_INT);

    if (!$id) {
        echo json_encode(["success" => false, "message" => "El ID del evento es obligatorio y debe ser un número válido."]);
        exit;
    }

    $response = $event->remove($id);
    echo json_encode($response);
    exit;
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
    exit;
}
?>