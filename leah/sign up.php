<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
} 
// Include functions for database connection and utility

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require ('functions.php'); 
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate password confirmation
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Register the user using the function
        $result = register_user($username, $password);

        if ($result === true) {
            $success = "Registration successful! You can now log in.";
        } else {
            $error = $result;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <?php include('header.php')?>
        <section id="signup" class="content-section">
            <div class="signup-container">
                <h2>Sign Up</h2>
                <?php if (isset($error)): ?>
                    <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <?php if (isset($success)): ?>
                    <p class="success"><?= htmlspecialchars($success) ?></p>
                <?php endif; ?>
                <form method="POST" action="sign up.php" class="signup-form">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                    
                    <button type="submit" class="btn">Sign Up</button>
                </form>
            </div>
        </section>

        <footer>
            <p>&copy; 2024 My Blog</p>
        </footer>
    </body>
</html>
