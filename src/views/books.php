<?php

require_once __DIR__ . '/../controllers/bookController.php';

$bookInstance = new Book();
$books = $bookInstance->findAll();
?>

<div class="container">
    <div class="header">
        <h1>Lista de libros</h1>

        <a class="back-button" href="../index.php">Volver</a>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Género</th>
                <th>Año Publicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="booksTableBody">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars(string: $book['author']); ?></td>
                        <td><?php echo htmlspecialchars(string: $book['book_genre']); ?></td>
                        <td><?php echo htmlspecialchars(string: $book['year_published']); ?></td>
                        <td>
                            <button class="btn edit-btn" onclick="editBook(
                                <?php echo $book['id']; ?>,
                                '<?php echo htmlspecialchars($book['title']); ?>',
                                '<?php echo htmlspecialchars($book['author']); ?>',
                                '<?php echo htmlspecialchars($book['book_genre']); ?>',
                                '<?php echo $book['year_published']; ?>'
                            )">✏️ Editar</button>
                            <button class="btn remove-btn" onclick="deleteBook(<?php echo $book['id']; ?>)">Borrar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay libros registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>