<?php

if (!isset($_GET['section']) || empty($_GET['section'])) {
  echo "<p style='color: red;'>Sección no válida o no especificada.</p>";
  exit;
}

$section = htmlspecialchars($_GET['section']);
$basePath = __DIR__ . '/../views/';
$componentsPath = __DIR__ . '/../components/';
$scriptsPath = "/scripts/";

$sections = [
  "createBook" => $componentsPath . "book_form.php",
  "viewBooks" => $basePath . "books.php",
  "createEvent" => $componentsPath . "event_form.php",
  "viewEvents" => $basePath . "events.php",
  "createReview" => $componentsPath . "review_form.php",
  "viewReviews" => $basePath . "reviews.php",
];

$sectionsJs = [
  "createBook" => $scriptsPath . "books.js",
  "viewBooks" => $scriptsPath . "books.js",
  "createEvent" => $scriptsPath . "events.js",
  "viewEvents" => $scriptsPath . "events.js",
  "createReview" => $scriptsPath . "reviews.js",
  "viewReviews" => $scriptsPath . "reviews.js",
];

if (array_key_exists($section, $sections) && file_exists($sections[$section])) {
  include $sections[$section];

  echo "<div id='script-loader' data-script='" . $sectionsJs[$section] . "'></div>";
} else {
  echo "<p style='color: red;'>La sección no existe.</p>";
}
?>