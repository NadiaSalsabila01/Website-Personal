<?php

date_default_timezone_set('Asia/Jakarta');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $comment = htmlspecialchars($_POST["comment"]);

    if (!empty($name) && !empty($comment)) {
        $entry = $name . "|" . $comment . "|" . date("Y-m-d H:i:s") . "\n";
        file_put_contents("comments.txt", $entry, FILE_APPEND);
    }
}

$comments = file_exists("comments.txt") ? file("comments.txt") : [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas Proyek Responsi Praktikum Pemograman Web</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Sistem Komentar Blog Mini</h1>

    <form method="POST" onsubmit="return validateForm()">
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" placeholder="Masukkan nama...">

        <label for="comment">Komentar:</label>
        <textarea name="comment" id="comment" placeholder="Tulis komentar..."></textarea>

        <button type="submit">Kirim Komentar</button>
    </form>

    <h2>Komentar Sebelumnya:</h2>
    <div class="comment-list">
        <?php if (empty($comments)): ?>
            <p class="empty">Belum ada komentar.</p>
        <?php else: ?>
            <?php foreach (array_reverse($comments) as $line): 
                $parts = explode("|", $line);
                if (count($parts) >= 3): ?>
                <div class="comment-box">
                    <strong><?= htmlspecialchars($parts[0]) ?>:</strong>
                    <p><?= htmlspecialchars($parts[1]) ?></p>
                    <small>Dikirim pada: <?= htmlspecialchars($parts[2]) ?></small>
                </div>
            <?php endif; endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>