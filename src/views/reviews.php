<?php

require_once __DIR__ . '/../controllers/reviewController.php';

$reviewInstance = new Review();
$reviews = $reviewInstance->findAll();
?>

<div class="container">
    <div class="header">
        <h1>Reseñas Registradas</h1>
        <a class="back-button" href="../index.php">Volver</a>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>Autor</th>
                <th>Título</th>
                <th>Reseña</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="reviewsTableBody">
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($review['user']); ?></td>
                        <td><?php echo htmlspecialchars($review['book_title']); ?></td>
                        <td><?php echo htmlspecialchars($review['comment']); ?></td>
                        <td><?php echo htmlspecialchars($review['date']); ?></td>
                        <td>
                            <button class="btn edit-btn" onclick="editReview(
                                        <?php echo $review['id']; ?>,
                                        '<?php echo $review['id_book']; ?>',
                                        '<?php echo $review['id_user']; ?>',
                                        '<?php echo htmlspecialchars($review['comment']); ?>',
                                        '<?php echo $review['date']; ?>'
                                    )">Editar</button>
                            <button class="btn remove-btn" onclick="deleteReview(<?php echo $review['id']; ?>)">Borrar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay reseñas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>