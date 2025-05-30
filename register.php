<?php
include_once 'classes/Users.php';

$usersModel = new Users('localhost', 'root', '', 'konyvtar');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($usersModel->register($name, $email, $password)) {
        header("Location: login.php");
        exit;
    } else {
        $error = "A regisztráció sikertelen!";
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4 w-100" style="max-width: 400px;">
        <h2 class="text-center mb-4 text-primary">Regisztráció</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Név</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Jelszó</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Regisztráció</button>
            <a href="login.php" class="btn btn-secondary w-100 mt-2">Már van fiókod? Jelentkezz be!</a>
        </form>
    </div>
</div>
</body>
</html>