<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../includes/security.php';

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
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <main class="dashboard-card">

        <p class="eyebrow">Sikeres bejelentkezés</p>

        <h1>Üdv, <?= htmlspecialchars($userName) ?>!</h1>

        <section class="profile-box">
            <h2>Felhasználói adatok</h2>

            <div class="profile-row">
                <span>Név</span>
                <strong><?= htmlspecialchars($userName) ?></strong>
            </div>

            <div class="profile-row">
                <span>E-mail cím</span>
                <strong><?= htmlspecialchars($userEmail) ?></strong>
            </div>
        </section>

        <a class="logout-button" href="logout.php">Kijelentkezés</a>

    </main>

</body>

</html>