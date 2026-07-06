<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../includes/db.php';

$name = '';
$email = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $passwordConfirm = $_POST['password_confirm'] ?? '';

    if ($name === '') {
        $errors[] = 'A név megadása kötelező.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Kérlek, adj meg egy érvényes e-mail címet.';
    }

    if (strlen($password) < 6) {
        $errors[] = 'A jelszónak legalább 6 karakter hosszúnak kell lennie.';
    }

    if ($password !== $passwordConfirm) {
        $errors[] = 'A két jelszó nem egyezik.';
    }

    if (empty($errors)) {
        $stmt = $connection->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = 'Ez az e-mail cím már regisztrálva van.';
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $connection->prepare(
                'INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)'
            );
            $stmt->bind_param('sss', $name, $email, $passwordHash);
            $stmt->execute();

            header('Location: index.php?registered=1');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció | Login Task</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<main>
    <h1>Regisztráció</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert error">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <label for="name">Név</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>

        <label for="email">E-mail cím</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

        <label for="password">Jelszó</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirm">Jelszó megerősítése</label>
        <input type="password" id="password_confirm" name="password_confirm" required>

        <button type="submit">Regisztráció</button>
    </form>

    <p>
        Már van fiókod?
        <a href="index.php">Bejelentkezés</a>
    </p>
</main>

<script src="../assets/js/jquery-3.7.1.min.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>