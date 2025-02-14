function saveReview(event) {
  event.preventDefault();
  const form = document.getElementById("reviewForm");
  const messageContainer = document.getElementById("reviewMessage");

  messageContainer.textContent = "";
  messageContainer.style.display = "none";

  const id = document.getElementById("reviewId").value;
  const id_book = document.getElementById("id_book").value;
  const id_user = document.getElementById("id_user").value;
  const comment = document.getElementById("comment").value.trim();
  const date = document.getElementById("date").value;

  if (!id_book || !id_user || !comment || !date) {
      messageContainer.innerHTML = `<p style="color: red;">Todos los campos son obligatorios.</p>`;
      messageContainer.style.display = "block";
      return;
  }

  const data = { id_book, id_user, comment, date };
  if (id) data.id = id;

  fetch("../operations/operations_review.php", {
      method: id ? "PUT" : "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
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
              form.reset();
              document.getElementById("reviewId").value = "";
              document.getElementById("submitButton").textContent = "Publicar reseña";
          }
          messageContainer.innerHTML = `<p style="color: ${data.success ? 'green' : 'red'};">${data.message}</p>`;
          messageContainer.style.display = "block";
      })
      .catch(error => {
          console.error("Error:", error);
          messageContainer.innerHTML = `<p style="color: red;">Error en la conexión con el servidor.</p>`;
          messageContainer.style.display = "block";
      });
}


function deleteReview(reviewId) {
  if (!confirm("¿Estás seguro de que deseas eliminar esta reseña?")) {
      return;
  }

  fetch("../operations/operations_review.php", {
      method: "DELETE",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id: reviewId })
  })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              alert("Reseña eliminada correctamente.");
              location.reload();
          } else {
              alert("Error al eliminar la reseña: " + data.message);
          }
      })
      .catch(error => {
          console.error("Error:", error);
          alert("Error en la conexión con el servidor.");
      }).finally(() => {
        clearTimeout();
    });
}

function editReview(id, id_book, id_user, comment, date) {
  setTimeout(() => {
  document.getElementById("reviewId").value = id;
  document.getElementById("id_book").value = id_book;
  document.getElementById("id_user").value = id_user;
  document.getElementById("comment").value = comment;
  document.getElementById("date").value = date;
  document.getElementById("submitButton").textContent = "Actualizar reseña";
}, 300);

}