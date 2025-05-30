<?php

include_once 'classes/Books.php';
include_once 'classes/Rents.php';

$booksModel = new Books("localhost", "root", "", "konyvtar");
$rentsModel = new Rents("localhost", "root", "", "konyvtar");
$books = $booksModel->getBooks();
$summary = $booksModel->getSummary();
$rents = $rentsModel->getRents();

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Könyvtár</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">📚 Kikölcsönzött/kölcsönözhető könyvek</h1>
        <a href="?todo=new" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Új könyv felvétele
        </a>
    </div>

    <?php if (empty($books)): ?>
        <div class="alert alert-warning">Nincs könyv felvéve.</div>
    <?php else: ?>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Könyvek</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Cím</th>
                        <th>Szerző</th>
                        <th>Év</th>
                        <th>ISBN</th>
                        <th>Leírás</th>
                        <th>Státusz</th>
                        <th>Művelet</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($books as $book): ?>
                        <?php
                        $kolcsonzott = false;
                        $kolcsonzes_datum = null;
                        $kolcsonzes_id = null;

                        foreach ($rents as $rent) {
                            if ($rent->book_id == $book->id && !$rent->returned) {
                                $kolcsonzott = true;
                                $kolcsonzes_datum = $rent->date;
                                $kolcsonzes_id = $rent->id;
                                break;
                            }
                        }
                        ?>
                        <tr>
                            <td><?= $book->id ?></td>
                            <td><?= htmlspecialchars($book->title) ?></td>
                            <td><?= htmlspecialchars($book->author) ?></td>
                            <td><?= $book->year ?></td>
                            <td><?= htmlspecialchars($book->isbn) ?></td>
                            <td><?= nl2br(htmlspecialchars($book->description)) ?></td>
                            <td>
                                <?php if ($kolcsonzott): ?>
                                    <?php
                                    $kolcsonzes_timestamp = strtotime($kolcsonzes_datum);
                                    $most = time();
                                    $eltelt = $most - $kolcsonzes_timestamp;
                                    $maradek = 60 - $eltelt;
                                    if ($maradek < 0) $maradek = 0;
                                    ?>
                                    <span class="badge bg-warning text-dark">
                                        Kölcsönözve<br>
                                        <span id="timer<?= $kolcsonzes_id ?>"></span>
                                    </span>
                                    <script>
                                        var sec<?= $kolcsonzes_id ?> = <?= $maradek ?>;
                                        var timer<?= $kolcsonzes_id ?> = setInterval(function () {
                                            var elem = document.getElementById("timer<?= $kolcsonzes_id ?>");
                                            if (sec<?= $kolcsonzes_id ?> > 0) {
                                                elem.innerText = sec<?= $kolcsonzes_id ?> + ' mp';
                                                sec<?= $kolcsonzes_id ?>--;
                                            } else {
                                                elem.innerText = 'Lejárt! Késedelmi díj jár visszahozáskor.';
                                                elem.className = 'text-danger fw-bold';
                                                clearInterval(timer<?= $kolcsonzes_id ?>);
                                            }
                                        }, 1000);
                                        document.addEventListener('DOMContentLoaded', function () {
                                            var elem = document.getElementById("timer<?= $kolcsonzes_id ?>");
                                            if (sec<?= $kolcsonzes_id ?> > 0) {
                                                elem.innerText = sec<?= $kolcsonzes_id ?> + ' mp';
                                            } else {
                                                elem.innerText = 'Lejárt! Késedelmi díj jár visszahozáskor.';
                                                elem.className = 'text-danger fw-bold';
                                            }
                                        });
                                    </script>
                                <?php else: ?>
                                    <span class="badge bg-success">Szabad</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="?todo=delete&id=<?= $book->id ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Biztosan törlöd ezt a könyvet?');">
                                        <i class="bi bi-trash"></i> Törlés
                                    </a>
                                    <?php if (!$kolcsonzott): ?>
                                        <a href="?todo=rent&id=<?= $book->id ?>"
                                           class="btn btn-sm btn-info text-white">
                                            <i class="bi bi-box-arrow-in-right"></i> Kölcsönzés
                                        </a>
                                    <?php else: ?>
                                        <a href="?todo=return&id=<?= $kolcsonzes_id ?>"
                                           class="btn btn-sm btn-success">
                                            <i class="bi bi-box-arrow-in-left"></i> Visszahozás
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="table-secondary fw-bold">
                        <td colspan="2">Összesen</td>
                        <td colspan="6"><?= isset($summary->total_books) ? $summary->total_books : count($books) ?> könyv</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php