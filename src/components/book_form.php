<div>
    <div>
        <h2 id="title">Registrar Libro</h2>
    </div>
    <form id="bookForm" onsubmit="saveBook(event)">
        <input type="hidden" id="bookId" name="id" value="<?php echo htmlspecialchars($bookId); ?>">

        <label for="title">Título:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>

        <label for="author">Autor:</label>
        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($author); ?>" required>

        <label for="book_genre">Género:</label>
        <input type="text" id="book_genre" name="book_genre" value="<?php echo htmlspecialchars($bookGenre); ?>"
            required>

        <label for="year_published">Año Publicación:</label>
        <input type="number" id="year_published" name="year_published"
            value="<?php echo htmlspecialchars($yearPublished); ?>" required min="1000" max="9999">

        <button type="submit" id="submitButton">
            <?php echo $bookId ? 'Actualizar libro' : 'Agregar libro'; ?>
        </button>
    </form>

    <div id="bookMessage"></div>
</div>