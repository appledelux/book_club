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
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                    <th>Acciones</th>
                <?php endif; ?>
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
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                            <td>
                                <button class="btn edit-btn" onclick="showSection('createReview'), editReview(
                                        <?php echo $review['id']; ?>,
                                        '<?php echo $review['book_id']; ?>',
                                        '<?php echo $review['user_id']; ?>',
                                        '<?php echo htmlspecialchars($review['comment']); ?>',
                                        '<?php echo $review['date']; ?>'
                                    )">Editar</button>
                                <button class="btn remove-btn" onclick="deleteReview(<?php echo $review['id']; ?>)">Borrar</button>
                            </td>
                        <?php endif; ?>
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