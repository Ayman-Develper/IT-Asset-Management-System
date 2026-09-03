<?php

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed.');
}

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id) {
    exit('Invalid asset ID.');
}

$stmt = $pdo->prepare(
    'DELETE FROM assets
     WHERE id = :id'
);

$stmt->execute([
    'id' => $id
]);

header('Location: index.php');
exit;