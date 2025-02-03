<?php
require_once "config.php";
?>
<script>
    function addReview(event) {
        const SAVE_REVIEW = "<?php echo SAVE_REVIEW; ?>";
        event.preventDefault(); // Evita que la página se recargue

        let formData = new FormData(document.getElementById("reviewForm"));

        fetch(SAVE_REVIEW, {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateEventList(data.reviews);
                    document.getElementById("reviewForm").reset();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error:", error));
    }

    function updateEventList(events) {
        let tableBody = document.getElementById("reviewsTableBody");

        if (!tableBody) return;

        tableBody.innerHTML = "";

        events.forEach(event => {
            let row = document.createElement("tr");
            row.innerHTML = `
                    <td>${event.review}</td>
                `;
            tableBody.appendChild(row);
        });
    }
</script>
<form id="reviewForm" onsubmit="addReview(event)" method="post">
    <label for="title">Nombre del libro:</label>
    <input type="text" id="title" name="title" required>
    <label for="author">Autor:</label>
    <input type="text" id="author" name="author" required>
    <label for="review">Reseña:</label>
    <textarea id="review" name="review" required></textarea>

    <button type="submit">Publicar reseña</button>
</form>