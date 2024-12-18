<?php
session_start();
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $user_id = authenticate_user($username, $password);

    if ($user_id) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <?php include('header.php')?>
        <section id="signup" class="content-section">
            <div class="signup-container">
                <h1>Login</h1>
                <?php if (isset($error)): ?>
                    <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <form action="login.php" method="POST">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                    
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                    
                    <button type="submit">Login</button>
                </form>
            </div>
        </section>
    </body>
</html>
