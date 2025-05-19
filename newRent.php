<?php
$book_id = $_GET['id'] ?? 0;
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Kölcsönzés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-sm p-4 w-100" style="max-width: 500px;">
        <h2 class="text-center mb-4 text-info">
            <i class="bi bi-box-arrow-in-right"></i> Könyv kölcsönzése
        </h2>
        <form action="?todo=rent_add" method="POST" class="mb-3">
            <input type="hidden" name="book_id" value="<?= htmlspecialchars($book_id) ?>">
            <input type="hidden" name="date" value="<?= date('Y-m-d H:i:s') ?>">

            <div class="mb-3">
                <label for="renter_name" class="form-label">Kölcsönző neve</label>
                <input type="text" class="form-control" id="renter_name" name="renter_name" placeholder="Pl. Kovács Péter" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-info text-white">
                    <i class="bi bi-check-lg"></i> Kölcsönzés
                </button>
                <a href="index.php" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Mégsem
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
