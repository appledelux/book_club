<?php
require_once "../config.php";
$file = '../data/events.json';
$events = [];

if (file_exists($file)) {
    $jsonData = file_get_contents($file);
    $events = json_decode($jsonData, true) ?? [];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Próximos Eventos</title>
</head>

<body>
    <h1>Próximos Eventos</h1>
    <?php include 'event_form.php'; ?>

    <hr>
    <h2>Lista de eventos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody id="eventsTableBody">
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?php echo htmlspecialchars($event['title']); ?></td>
                    <td><?php echo htmlspecialchars($event['date']); ?></td>
                    <td><?php echo htmlspecialchars($event['description']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="../index.php">Volver al inicio</a>

</body>

</html>