<?php
$file = '../data/books.json';
$books = [];

if (file_exists($file)) {
    $jsonData = file_get_contents($file);
    $books = json_decode($jsonData, true) ?? [];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de libros</title>
</head>

<body>
    <h1>Lista de libros</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Género</th>
            </tr>
        </thead>
        <tbody id="booksTableBody">
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                    <td><?php echo htmlspecialchars($book['author']); ?></td>
                    <td><?php echo htmlspecialchars($book['book_genre']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="../index.php">Volver</a>

</body>

</html>