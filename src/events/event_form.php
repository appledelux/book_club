<script>
    function addEvent(event) {
        event.preventDefault(); // Evita que la página se recargue
        const SAVE_EVENT = "<?php echo SAVE_EVENT; ?>";

        let formData = new FormData(document.getElementById("eventForm"));

        fetch(SAVE_EVENT, {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateEventList(data.events);
                    document.getElementById("eventForm").reset();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error:", error));
    }

    function updateEventList(events) {
        let tableBody = document.getElementById("eventsTableBody");

        if (!tableBody) return;

        tableBody.innerHTML = ""; // Limpiar la tabla

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

<form id="eventForm" onsubmit="addEvent(event)">
    <label for="title">Nombre del evento:</label>
    <input type="text" id="title" name="title" required>

    <label for="date">Fecha:</label>
    <input type="date" id="date" name="date" required>

    <label for="description">Descripción:</label>
    <textarea id="description" name="description" required></textarea>

    <button type="submit">Agregar evento</button>
</form>