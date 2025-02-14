<?php
require_once __DIR__ . '/../controllers/bookController.php';
require_once __DIR__ . '/../controllers/userController.php';

$bookInstance = new Book();
$userInstance = new User();

$books = $bookInstance->findAll();
$users = $userInstance->findAll();
?>

<div>
    <div>
        <h2>Registrar Reseña</h2>
    </div>
    <form id="reviewForm" onsubmit="saveReview(event)" method="post">
        <input type="hidden" id="reviewId" name="id">

        <label for="id_book">Selecciona un libro:</label>
        <select id="id_book" name="id_book" required>
            <option value="">-- Selecciona un libro --</option>
            <?php foreach ($books as $book): ?>
                <option value="<?php echo htmlspecialchars($book['id']); ?>">
                    <?php echo htmlspecialchars($book['title']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="id_user">Selecciona un usuario:</label>
        <select id="id_user" name="id_user" required>
            <option value="">-- Selecciona un usuario --</option>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo htmlspecialchars($user['id']); ?>">
                    <?php echo htmlspecialchars($user['username']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="comment">Reseña:</label>
        <textarea id="comment" name="comment" required></textarea>

        <label for="date">Fecha:</label>
        <input type="date" id="date" name="date" required>

        <button type="submit" id="submitButton">Publicar reseña</button>
    </form>
    <div id="reviewMessage"></div>
</div>