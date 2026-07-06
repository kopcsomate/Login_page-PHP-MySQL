<?php

declare(strict_types=1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$userName = $_SESSION['user_name'] ?? '';
$userEmail = $_SESSION['user_email'] ?? '';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználói adatok | Login Task</title>
</head>
<body>

<main>
    <h1>Felhasználói adatok</h1>

    <p>Sikeresen bejelentkeztél.</p>

    <section>
        <h2>Profil</h2>

        <p>
            <strong>Név:</strong>
            <?= htmlspecialchars($userName) ?>
        </p>

        <p>
            <strong>E-mail cím:</strong>
            <?= htmlspecialchars($userEmail) ?>
        </p>
    </section>

    <p>
        <a href="logout.php">Kijelentkezés</a>
    </p>
</main>

</body>
</html>