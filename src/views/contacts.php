<?php
require_once __DIR__ . "/../config.php";
$file = __DIR__ . '/../data/contacts.json';
$contacts = [];

if (file_exists($file)) {
    $jsonData = file_get_contents($file);
    $contacts = json_decode($jsonData, true) ?? [];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>
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
</head>

<body>

    <h1>Contacto</h1>
    <?php include 'contact_form.php'; ?>

    <hr>

    <h2>Mensajes Recibidos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Mensaje</th>
            </tr>
        </thead>
        <tbody id="contactsTableBody">
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?php echo htmlspecialchars($contact['name']); ?></td>
                    <td><?php echo htmlspecialchars($contact['email']); ?></td>
                    <td><?php echo htmlspecialchars($contact['message']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="../index.php">Volver al inicio</a>

</body>

</html>