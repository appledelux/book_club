<?php
require_once __DIR__ . '/../controllers/reviewController.php';

header('Content-Type: application/json');
$review = new Review();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = json_decode(file_get_contents("php://input"), true);

    $id_book = isset($input['id_book']) ? intval($input['id_book']) : null;
    $id_user = isset($input['id_user']) ? intval($input['id_user']) : null;
    $comment = trim($input['comment'] ?? '');
    $date = $input['date'] ?? '';
    $dateObj = DateTime::createFromFormat('Y-m-d', $date);

    if (!$id_book || !$id_user || empty($comment) || !$dateObj) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios y deben ser válidos."]);
        exit;
    }

    $formattedDate = $dateObj->format('Y-m-d H:i:s');

    $response = $review->save($comment, $formattedDate, $id_book, $id_user);
    echo json_encode($response);
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);

    $id = filter_var($data['id'] ?? '', FILTER_VALIDATE_INT);
    $id_book = filter_var($data['id_book'] ?? '', FILTER_VALIDATE_INT);
    $id_user = filter_var($data['id_user'] ?? '', FILTER_VALIDATE_INT);
    $comment = trim($data['review'] ?? '');
    $date = date('Y-m-d H:i:s');

    if (!$id || !$id_book || !$id_user || empty($comment)) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios para actualizar."]);
        exit;
    }

    $response = $review->update($id, $comment, $date, $id_book, $id_user);
    echo json_encode($response);
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);

    $id = filter_var($data['id'] ?? '', FILTER_VALIDATE_INT);

    if (!$id) {
        echo json_encode(["success" => false, "message" => "El ID de la reseña es obligatorio y debe ser válido."]);
        exit;
    }

    $response = $review->remove($id);
    echo json_encode($response);
    exit;

} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
    exit;
}
?>