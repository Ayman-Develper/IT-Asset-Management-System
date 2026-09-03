<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/header.php';

$errors = [];

$assetTag = '';
$assetType = '';
$brand = '';
$model = '';
$serialNumber = '';
$status = 'Available';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $assetTag = trim($_POST['asset_tag'] ?? '');
    $assetType = trim($_POST['asset_type'] ?? '');
    $brand = trim($_POST['brand'] ?? '');
    $model = trim($_POST['model'] ?? '');
    $serialNumber = trim($_POST['serial_number'] ?? '');
    $status = trim($_POST['status'] ?? 'Available');

    if ($assetTag === '') {
        $errors[] = 'Asset tag is required.';
    }

    if ($assetType === '') {
        $errors[] = 'Asset type is required.';
    }

    if (empty($errors)) {

        $sql = '
            INSERT INTO assets (
                asset_tag,
                asset_type,
                brand,
                model,
                serial_number,
                status
            )
            VALUES (
                :asset_tag,
                :asset_type,
                :brand,
                :model,
                :serial_number,
                :status
            )
        ';

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            'asset_tag' => $assetTag,
            'asset_type' => $assetType,
            'brand' => $brand ?: null,
            'model' => $model ?: null,
            'serial_number' => $serialNumber ?: null,
            'status' => $status,
        ]);

        header('Location: index.php');
        exit;
    }
}

?>

<h2>Add Asset</h2>

<?php foreach ($errors as $error): ?>

    <p class="error">
        <?= e($error) ?>
    </p>

<?php endforeach; ?>

<form method="POST">

    <label for="asset_tag">
        Asset Tag
    </label>

    <input
        id="asset_tag"
        name="asset_tag"
        value="<?= e($assetTag) ?>"
        required
    >

    <label for="asset_type">
        Asset Type
    </label>

    <input
        id="asset_type"
        name="asset_type"
        value="<?= e($assetType) ?>"
        required
    >

    <label for="brand">
        Brand
    </label>

    <input
        id="brand"
        name="brand"
        value="<?= e($brand) ?>"
    >

    <label for="model">
        Model
    </label>

    <input
        id="model"
        name="model"
        value="<?= e($model) ?>"
    >

    <label for="serial_number">
        Serial Number
    </label>

    <input
        id="serial_number"
        name="serial_number"
        value="<?= e($serialNumber) ?>"
    >

    <label for="status">
        Status
    </label>

    <select
        id="status"
        name="status"
    >

        <option
            value="Available"
            <?= $status === 'Available' ? 'selected' : '' ?>
        >
            Available
        </option>

        <option
            value="Assigned"
            <?= $status === 'Assigned' ? 'selected' : '' ?>
        >
            Assigned
        </option>

        <option
            value="Maintenance"
            <?= $status === 'Maintenance' ? 'selected' : '' ?>
        >
            Maintenance
        </option>

        <option
            value="Retired"
            <?= $status === 'Retired' ? 'selected' : '' ?>
        >
            Retired
        </option>

    </select>

    <button type="submit">
        Create Asset
    </button>

</form>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>