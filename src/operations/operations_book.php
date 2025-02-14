<?php

require_once __DIR__ . '/../controllers/bookController.php';
header('Content-Type: application/json');
$book = new Book();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = json_decode(file_get_contents("php://input"), true);

    $title = $input['title'] ?? '';
    $author = $input['author'] ?? '';
    $book_genre = $input['book_genre'] ?? '';
    $year_published = filter_var($input['year_published'] ?? '', FILTER_VALIDATE_INT);

    if (empty($title) || empty($author) || empty($book_genre) || !$year_published) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios y deben ser válidos."]);
        exit;
    }

    $response = $book->save($title, $author, $book_genre, $year_published);
    echo json_encode($response);
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);

    $id = filter_var($data['id'] ?? '', FILTER_VALIDATE_INT);
    $title = $data['title'] ?? '';
    $author = $data['author'] ?? '';
    $book_genre = $data['book_genre'] ?? '';
    $year_published = filter_var($data['year_published'] ?? '', FILTER_VALIDATE_INT);

    if (!$id || empty($title) || empty($author) || empty($book_genre) || !$year_published) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios para actualizar."]);
        exit;
    }

    $response = $book->update($id, $title, $author, $book_genre, $year_published);
    echo json_encode($response);
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);

    $id = filter_var($data['id'] ?? '', FILTER_VALIDATE_INT);

    if (!$id) {
        echo json_encode(["success" => false, "message" => "El ID del libro es obligatorio y debe ser válido."]);
        exit;
    }

    $response = $book->remove($id);
    echo json_encode($response);
    exit;
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
    exit;
}
?>