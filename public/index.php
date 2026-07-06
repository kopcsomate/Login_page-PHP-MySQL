<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/security.php';

$email = '';
$errors = [];

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Érvénytelen űrlapbeküldés. Kérlek, próbáld újra.';
    }

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Kérlek, adj meg egy érvényes e-mail címet.';
    }

    if ($password === '') {
        $errors[] = 'A jelszó megadása kötelező.';
    }

    if (empty($errors)) {
        $stmt = $connection->prepare(
            'SELECT id, name, email, password_hash FROM users WHERE email = ?'
        );

        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password_hash'])) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            header('Location: dashboard.php');
            exit;
        }

        $errors[] = 'Hibás e-mail cím vagy jelszó.';
    }
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés | Login Task</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
</head>

<body>

    <main>
        <div class="logo">
            <div class="logo-icon">
                <span></span>
            </div>
        </div>
        <h1>Bejelentkezés</h1>

        <?php if (isset($_GET['registered'])): ?>
            <div class="alert success">
                <p>Sikeres regisztráció. Most már bejelentkezhetsz.</p>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post">

            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars(generateCsrfToken()) ?>">

            <label for="email">E-mail cím</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

            <label for="password">Jelszó</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Bejelentkezés</button>

        </form>

        <p>
            Még nincs fiókod?
            <a href="register.php">Regisztráció</a>
        </p>

    </main>

    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/main.js"></script>

</body>

</html>