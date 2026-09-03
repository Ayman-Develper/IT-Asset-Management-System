<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/header.php';

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id) {
    die('Invalid asset ID.');
}

$stmt = $pdo->prepare(
    'SELECT *
     FROM assets
     WHERE id = :id'
);

$stmt->execute([
    'id' => $id
]);

$asset = $stmt->fetch();

if (!$asset) {
    die('Asset not found.');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $assetTag = trim($_POST['asset_tag'] ?? '');
    $assetType = trim($_POST['asset_type'] ?? '');
    $brand = trim($_POST['brand'] ?? '');
    $model = trim($_POST['model'] ?? '');
    $serialNumber = trim($_POST['serial_number'] ?? '');
    $status = trim($_POST['status'] ?? '');

    if ($assetTag === '') {
        $errors[] = 'Asset tag is required.';
    }

    if ($assetType === '') {
        $errors[] = 'Asset type is required.';
    }

    if (empty($errors)) {

        $sql = '
            UPDATE assets
            SET
                asset_tag = :asset_tag,
                asset_type = :asset_type,
                brand = :brand,
                model = :model,
                serial_number = :serial_number,
                status = :status
            WHERE id = :id
        ';

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            'asset_tag' => $assetTag,
            'asset_type' => $assetType,
            'brand' => $brand ?: null,
            'model' => $model ?: null,
            'serial_number' => $serialNumber ?: null,
            'status' => $status,
            'id' => $id,
        ]);

        header('Location: index.php');
        exit;
    }

    $asset = [
        'asset_tag' => $assetTag,
        'asset_type' => $assetType,
        'brand' => $brand,
        'model' => $model,
        'serial_number' => $serialNumber,
        'status' => $status,
    ];
}

?>

<h2>Edit Asset</h2>

<?php foreach ($errors as $error): ?>

    <p class="error">
        <?= e($error) ?>
    </p>

<?php endforeach; ?>

<form method="POST">

    <label>
        Asset Tag
    </label>

    <input
        name="asset_tag"
        value="<?= e($asset['asset_tag']) ?>"
        required
    >

    <label>
        Asset Type
    </label>

    <input
        name="asset_type"
        value="<?= e($asset['asset_type']) ?>"
        required
    >

    <label>
        Brand
    </label>

    <input
        name="brand"
        value="<?= e($asset['brand']) ?>"
    >

    <label>
        Model
    </label>

    <input
        name="model"
        value="<?= e($asset['model']) ?>"
    >

    <label>
        Serial Number
    </label>

    <input
        name="serial_number"
        value="<?= e($asset['serial_number']) ?>"
    >

    <label>
        Status
    </label>

    <select name="status">

        <?php

        $statuses = [
            'Available',
            'Assigned',
            'Maintenance',
            'Retired'
        ];

        ?>

        <?php foreach ($statuses as $status): ?>

            <option
                value="<?= e($status) ?>"
                <?= $asset['status'] === $status ? 'selected' : '' ?>
            >
                <?= e($status) ?>
            </option>

        <?php endforeach; ?>

    </select>

    <button type="submit">
        Update Asset
    </button>

</form>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>