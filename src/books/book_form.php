<?php
require_once "config.php";
?>
<script>
    function addBook(event) {
        event.preventDefault();
        const SAVE_BOOK = "<?php echo SAVE_BOOK; ?>";

        let formData = new FormData(document.getElementById("bookForm"));

        fetch(SAVE_BOOK, {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateEventList(data.books);
                    document.getElementById("bookForm").reset();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error:", error));
    }

    function updateEventList(events) {
        let tableBody = document.getElementById("eventsTableBody");
        tableBody.innerHTML = "";

        if (!tableBody) return;

        events.forEach(event => {
            let row = document.createElement("tr");
            row.innerHTML = `
                    <td>${event.title}</td>
                    <td>${event.date}</td>
                    <td>${event.description}</td>
                `;
            tableBody.appendChild(row);
        });
    }
</script>
<form id="bookForm" onsubmit="addBook(event)">
    <label for="title">Título:</label>
    <input type="text" id="title" name="title">

    <label for="author">Autor:</label>
    <input type="text" id="author" name="author">

    <label for="book_genre">Género:</label>
    <input type="text" id="book_genre" name="book_genre">

    <button type="submit">Agregar libro</button>
</form>