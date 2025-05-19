<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Új könyv hozzáadása</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4 w-100" style="max-width: 600px;">
        <h2 class="text-center mb-4 text-primary">
            <i class="bi bi-journal-plus"></i> Új könyv hozzáadása
        </h2>
        <form action="?todo=add" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Cím</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Pl. A három test probléma" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Szerző</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="Pl. Liu Cixin" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Kiadás éve</label>
                <input type="number" class="form-control" id="year" name="year" min="1000" max="9999" placeholder="Pl. 2008">
            </div>
            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Pl. 978-963-0-00000-0">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Leírás</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Rövid tartalom..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-check-circle"></i> Hozzáadás
            </button>
            <a href="index.php" class="btn btn-secondary w-100 mt-2">
                <i class="bi bi-x-circle"></i> Vissza
            </a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
