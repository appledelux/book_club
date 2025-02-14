<div>
    <div>
        <h2>Registrar Evento</h2>
    </div>

    <form id="eventForm" onsubmit="saveEvent(event)">
        <input type="hidden" id="eventId" name="id">

        <label for="eventTitle">Nombre del Evento:</label>
        <input type="text" id="eventTitle" name="eventTitle" required>

        <label for="eventDate">Fecha:</label>
        <input type="date" id="eventDate" name="date" required>

        <label for="eventDescription">Descripción:</label>
        <textarea id="eventDescription" name="description" required></textarea>

        <button type="submit" id="eventSubmitButton">Agregar evento</button>
    </form>

    <div id="eventMessage"></div>
</div>