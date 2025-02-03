<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $review = $_POST['review'] ?? '';

    if (empty($review) || empty($author) || empty($review)) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
        exit();
    }

    $file = '../data/reviews.json';
    $reviews = [];

    if (file_exists($file)) {
        $jsonData = file_get_contents($file);
        $reviews = json_decode($jsonData, true) ?? [];
    }

    $newReview = [
        "review" => $review,
        "title" => $title,
        "author" => $author
    ];

    $reviews[] = $newReview;

    if (file_put_contents($file, json_encode($reviews, JSON_PRETTY_PRINT))) {
        echo json_encode(["success" => true, "reviews" => $reviews]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al guardar la reseña."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}
?>