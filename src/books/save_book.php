<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $book_genre = $_POST['book_genre'] ?? '';


    if (empty($title) || empty($author) || empty($book_genre)) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
        exit();
    }

    $file = '../data/books.json';
    $events = [];

    if (file_exists($file)) {
        $jsonData = file_get_contents($file);
        $contacts = json_decode($jsonData, true) ?? [];
    }

    $newBook = [
        "title" => $_POST["title"],
        "author" => $_POST["author"],
        "book_genre" => $_POST["book_genre"]
    ];

    $books[] = $newBook;

    if (file_put_contents($file, json_encode($books, JSON_PRETTY_PRINT))) {
        echo json_encode(["success" => true, "books" => $books]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al guardar el libro."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}
?>