<script>
    function addContact(event) {
        event.preventDefault();
        const SAVE_CONTACT = "<?php echo SAVE_CONTACT; ?>";

        let formData = new FormData(document.getElementById("contactForm"));

        fetch(SAVE_CONTACT, {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateContactList(data.contacts);
                    document.getElementById("contactForm").reset();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error:", error));
    }

    function updateContactList(contacts) {
        let tableBody = document.getElementById("contactsTableBody");
        tableBody.innerHTML = "";

        if (!tableBody) return;

        contacts.forEach(contact => {
            let row = document.createElement("tr");
            row.innerHTML = `
                    <td>${contact.name}</td>
                    <td>${contact.email}</td>
                    <td>${contact.message}</td>
                `;
            tableBody.appendChild(row);
        });
    }
</script>
<form id="contactForm" onsubmit="addContact(event)">
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Mensaje:</label>
    <textarea id="message" name="message" required></textarea>

    <button type="submit">Enviar</button>
</form>