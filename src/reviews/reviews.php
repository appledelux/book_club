<?php

$file = './data/reviews.json';
$reviews = [];

if (file_exists($file)) {
    $jsonData = file_get_contents($file);
    $reviews = json_decode($jsonData, true) ?? [];
}
?>

<h2>Últimas Reseñas</h2>
<table border="1">
    <thead>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Reseña</th>
        </tr>
    </thead>
    <tbody id="reviewsTableBody">
        <?php foreach ($reviews as $review): ?>
            <tr>
                <td><?php echo htmlspecialchars($review['title']); ?></td>
                <td><?php echo htmlspecialchars($review['author']); ?></td>
                <td><?php echo htmlspecialchars($review['review']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>