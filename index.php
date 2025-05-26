<?php
session_start();
include_once 'Books.php';
include_once 'Rents.php';
include_once 'Users.php';

// Ellenőrzés: Be van-e jelentkezve a felhasználó
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$todo = $_GET['todo'] ?? '';
$booksModel = new Books('localhost', 'root', '', 'konyvtar');
$rentsModel = new Rents('localhost', 'root', '', 'konyvtar');
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Könyvtár</title>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">📚 Könyvtár</h1>
            <div>
                <span class="me-3">Üdv, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
                <a href="logout.php" class="btn btn-danger">Kijelentkezés</a>
            </div>
        </div>

        <?php
        if ($todo == "new") {
            include_once 'newBook.php';
        } else if ($todo == "add") {
            $book = new Book(0, $_POST['title'], $_POST['author'], $_POST['year'], $_POST['isbn'], $_POST['description']);
            $booksModel->addBooks($book);
            header("Location: index.php");
            exit;
        } else if ($todo == "delete") {
            $booksModel->deleteBooks($_GET['id']);
            header("Location: index.php");
            exit;
        } else if ($todo == "rent") {
            include_once 'newRent.php';
        } else if ($todo == "rent_add") {
            $rent = new Rent(0, $_POST['book_id'], $_POST['renter_name'], $_POST['date'], 0);
            $rentsModel->addRent($rent);
            header("Location: index.php");
            exit;
        } else if ($todo == "return") {
            // Késedelmi díj ellenőrzése
            $rent_id = $_GET['id'] ?? null;
            if (!$rent_id || !is_numeric($rent_id)) {
                echo "<div class='alert alert-danger'>Érvénytelen kölcsönzés azonosító!</div>";
                exit;
            }

            $rents = $rentsModel->getRents();
            $kolcsonzes = null;
            foreach ($rents as $rent) {
                if ($rent->id == $rent_id) {
                    $kolcsonzes = $rent;
                    break;
                }
            }

            if (!$kolcsonzes) {
                echo "<div class='alert alert-danger'>A kölcsönzés nem található!</div>";
                exit;
            }

            $kolcsonzes_timestamp = strtotime($kolcsonzes->date);
            $most = time();
            $lejart = ($most - $kolcsonzes_timestamp) > 60; // 60 másodperc a tesztidő

            $rentsModel->returnBook($rent_id);

            if ($lejart) {
                echo "<div class='alert alert-danger mt-3'>Késedelmi díj: 500 Ft! (Több mint 1 perc telt el a kölcsönzés óta.)</div>";
                echo "<a href='index.php' class='btn btn-primary mt-2'>Vissza a főoldalra</a>";
                exit;
            }

            header("Location: index.php");
            exit;
        } else {
            include_once 'listBooks.php';
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>