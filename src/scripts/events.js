function saveEvent() {
  event.preventDefault();
  const eventForm = document.getElementById("eventForm");
  const eventMessageContainer = document.getElementById("eventMessage");
  const eventSubmitButton = document.getElementById("eventSubmitButton");
  const EVENT_API = "../operations/operations_event.php";

  const id = document.getElementById("eventId").value;
  const title = document.getElementById("eventTitle").value.trim();
  const date = document.getElementById("eventDate").value;
  const description = document.getElementById("eventDescription").value.trim();

  if (!title || !date || !description) {
      eventMessageContainer.innerHTML = `<p style="color: red;">Todos los campos son obligatorios.</p>`;
      eventMessageContainer.style.display = "block";
      return;
  }

  const eventData = { title, date, description };
  if (id) eventData.id = id;

  fetch(EVENT_API, {
      method: id ? "PUT" : "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(eventData)
  })
    .then(response => {
      if (!response.ok) {
          throw new Error(`Error HTTP! Estado: ${response.status}`);
      }
      return response.text();
    })
    .then(text => {
      try {
          return JSON.parse(text);
      } catch (error) {
        throw new Error("Respuesta del servidor no es un JSON válido: " + text);
      }
    })
      .then(data => {
          if (data.success) {
              eventForm.reset();
              document.getElementById("eventId").value = "";
              eventSubmitButton.textContent = "Agregar evento";
          }
          eventMessageContainer.innerHTML = `<p style="color: ${data.success ? 'green' : 'red'};">${data.message}</p>`;
          eventMessageContainer.style.display = "block";
      })
      .catch(error => {
          console.error("Error:", error);
          eventMessageContainer.innerHTML = `<p style="color: red;">Error en la conexión con el servidor.</p>`;
          eventMessageContainer.style.display = "block";
      });
}

function deleteEvent(eventId) {
  if (!confirm("¿Estás seguro de que deseas eliminar este evento?")) {
      return;
  }

  fetch("../operations/operations_event.php", {
      method: "DELETE",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id: eventId })
  })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              alert("Evento eliminado correctamente.");
              location.reload();
          } else {
              alert("Error al eliminar el evento: " + data.message);
          }
      })
      .catch(error => {
          console.error("Error:", error);
          alert("Error en la conexión con el servidor.");
      });
}

function editEvent(id, title, date, description) {
  setTimeout(() => {
  document.getElementById("eventId").value = id;
  document.getElementById("eventTitle").value = title;
  document.getElementById("eventDate").value = date;
  document.getElementById("eventDescription").value = description;
  document.getElementById("eventSubmitButton").textContent = "Actualizar evento";
}, 300);

}





