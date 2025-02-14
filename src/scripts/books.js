function saveBook(event) {
    event.preventDefault();
    const form = document.getElementById("bookForm");
    const messageContainer = document.getElementById("bookMessage");

    messageContainer.textContent = "";
    messageContainer.style.display = "none";

    const id = document.getElementById("bookId").value;
    const title = document.getElementById("title").value.trim();
    const author = document.getElementById("author").value.trim();
    const book_genre = document.getElementById("book_genre").value.trim();
    const year_published = document.getElementById("year_published").value;

    if (!title || !author || !book_genre || !year_published) {
        messageContainer.innerHTML = `<p style="color: red;">Todos los campos son obligatorios.</p>`;
        messageContainer.style.display = "block";
        return;
    }

    const data = { title, author, book_genre, year_published };
    if (id) data.id = id;

    fetch("../operations/operations_book.php", {
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
                document.getElementById("bookId").value = "";
                document.getElementById("submitButton").textContent = "Agregar libro";
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


function deleteBook(bookId) {
  if (!confirm("¿Estás seguro de que deseas eliminar este libro?")) {
      return;
  }

  fetch("../operations/operations_book.php", {
      method: "DELETE",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id: bookId })
  })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              alert("Libro eliminado correctamente.");
              location.reload();
          } else {
              alert("Error al eliminar el libro: " + data.message);
          }
      })
      .catch(error => {
          console.error("Error:", error);
          alert("Error en la conexión con el servidor.");
      });
}

function editBook(id, title, author, book_genre, year_published) {
    setTimeout(() => {
        document.getElementById("bookId").value = id;
  document.getElementById("title").value = title;
  document.getElementById("author").value = author;
  document.getElementById("book_genre").value = book_genre;
  document.getElementById("year_published").value = year_published;
  document.getElementById("submitButton").textContent = "Actualizar libro";
    }, 300);
}