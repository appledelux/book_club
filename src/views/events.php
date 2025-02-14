<?php

require_once __DIR__ . '/../controllers/eventController.php';

$eventInstance = new Event();
$events = $eventInstance->findAll();
?>

<div class="container">
    <div class="header">
        <h1>Lista de Eventos</h1>
        <a class="back-button" href="../index.php">Volver</a>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody id="eventsTableBody">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($event['title']); ?></td>
                        <td><?php echo htmlspecialchars($event['date']); ?></td>
                        <td><?php echo htmlspecialchars($event['description']); ?></td>
                        <td>
                            <button class="btn edit-btn" onclick="editEvent(
                                <?php echo $event['id']; ?>,
                                '<?php echo htmlspecialchars($event['title']); ?>',
                                '<?php echo $event['date']; ?>',
                                '<?php echo htmlspecialchars($event['description']); ?>'
                            )">Editar</button>
                            <button class="btn remove-btn" id="deleteEvent"
                                onclick="deleteEvent(<?php echo $event['id']; ?>)">Borrar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay eventos programados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>