<div>
    <div>
        <h2>Registrar Libro</h2>
    </div>
    <form id="bookForm" onsubmit="saveBook(event)">
        <input type="hidden" id="bookId" name="id">

        <label for="title">Título:</label>
        <input type="text" id="title" name="title" required>

        <label for="author">Autor:</label>
        <input type="text" id="author" name="author" required>

        <label for="book_genre">Género:</label>
        <input type="text" id="book_genre" name="book_genre" required>

        <label for="year_published">Año Publicación:</label>
        <input type="number" id="year_published" name="year_published" required min="1000" max="9999">

        <button type="submit" id="submitButton">Agregar libro</button>
    </form>

    <div id="bookMessage"></div>
</div>