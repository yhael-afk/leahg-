<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blog </title>
    <link rel="stylesheet" href="signin.css"> <!-- Link to external CSS file -->
</head>
<body>

    <?php include 'header.php'; ?>

<main>
    <section class="login">
        <div class="signincontainer">
            <h2>Create your account</h2>
            <form id="signinForm">
                <div class="input-group">
                    <input type="text" id="fname" placeholder="Enter your firstname" required />
                </div>
                <div class="input-group">
                    <input type="text" id="lname" placeholder="Enter your lastname" required />
                </div>
                <div class="input-group">
                    <input type="text" id="uname" placeholder="Enter your username" required />
                </div>
                <div class="input-group">
                    <input type="email" id="email" placeholder="Enter your email" required />
                </div>
                <div class="input-group">
                    <button type="submit">Sign In</button>
                </div>
            </form>
            Already have an account?<a href = 'login.php' > Log In </a>
        </div>
    </section>
</main>

<footer>
    <div class="container" style="text-align: center;">
        <p>&copy; 2024 SK Sugod Karon. All rights reserved.</p>
    </div>
</footer>

<script src="signin.js"></script> <!-- Link to external JavaScript file -->
</body>
</html>