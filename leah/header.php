<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="header.css">
    </head>
    <body>
        <header>
            <div class="nav-container">
                <nav>
                    <ul class="nav-links">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="index.php#posts" id="posts-link">Posts</a></li>
                            <li><a href="index.php#categories" id="categories-link">Categories</a></li>
                        <?php if (!isset($_SESSION['user_id'])): ?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="sign up.php" id="register-link">Register</a></li>
                        <?php else: ?>
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="log out.php">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </header>
    </body>
<html>