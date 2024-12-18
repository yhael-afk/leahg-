<?php
// Database Connection
function db_connect() {
    $conn = new mysqli("localhost", "root", "", "food_blog");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

//Register User
function register_user($username, $password) {
    $conn = db_connect();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);
    $success = $stmt->execute();

    $stmt->close();
    $conn->close();
    return $success ? true : "Registration failed.";
}
// Authenticate User
function authenticate_user($username, $password) {
    $conn = db_connect();

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $user && password_verify($password, $user['password']) ? $user['id'] : false;
}
// Add Post
function add_post($user_id, $title, $content) {
    $conn = db_connect();
    $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $content);
    $success = $stmt->execute();

    $stmt->close();
    $conn->close();
    return $success;
}

// Get Posts
function get_posts() {
    $conn = db_connect();
    $result = $conn->query("SELECT posts.id, posts.title, posts.content, users.username, posts.created_at 
                            FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");

    $posts = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $posts;
}

// Add Comment
function add_comment($post_id, $user_id, $comment) {
    $conn = db_connect();
    $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $post_id, $user_id, $comment);
    $success = $stmt->execute();

    $stmt->close();
    $conn->close();
    return $success;
}

// Add Like
function add_like($post_id, $user_id) {
    $conn = db_connect();
    $stmt = $conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $post_id, $user_id);
    $success = $stmt->execute();

    $stmt->close();
    $conn->close();
    return $success;
}
?>


