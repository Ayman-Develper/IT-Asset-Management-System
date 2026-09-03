<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/header.php';

$stmt = $pdo->query(
    'SELECT *
     FROM assets
     ORDER BY id DESC'
);

$assets = $stmt->fetchAll();

?>

<h2>Assets</h2>

<a
    class="button"
    href="create.php"
>
    Add Asset
</a>

<?php if (empty($assets)): ?>

    <p>No assets found.</p>

<?php else: ?>

<table>

    <thead>
        <tr>
            <th>ID</th>
            <th>Asset Tag</th>
            <th>Type</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Serial Number</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach ($assets as $asset): ?>

        <tr>

            <td>
                <?= e((string) $asset['id']) ?>
            </td>

            <td>
                <?= e($asset['asset_tag']) ?>
            </td>

            <td>
                <?= e($asset['asset_type']) ?>
            </td>

            <td>
                <?= e($asset['brand']) ?>
            </td>

            <td>
                <?= e($asset['model']) ?>
            </td>

            <td>
                <?= e($asset['serial_number']) ?>
            </td>

            <td>
                <?= e($asset['status']) ?>
            </td>

            <td>

                <a
                    href="edit.php?id=<?= e((string) $asset['id']) ?>"
                >
                    Edit
                </a>

                <form
                    action="delete.php"
                    method="POST"
                    style="display:inline;"
                >

                    <input
                        type="hidden"
                        name="id"
                        value="<?= e((string) $asset['id']) ?>"
                    >

                    <button type="submit">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>

</table>

<?php endif; ?>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>