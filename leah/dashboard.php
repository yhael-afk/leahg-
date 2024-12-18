<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
include ('header.php');
include ('leah.php'); // Include your database connection file

// Handling new post submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'create_post') {
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $user_id = $_SESSION['user_id'];

        $stmt = $db->prepare("INSERT INTO posts (user_id, title, content, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iss", $user_id, $title, $content);
        $stmt->execute();
    } elseif ($_POST['action'] === 'add_comment') {
        $post_id = (int)$_POST['post_id'];
        $comment = htmlspecialchars($_POST['comment']);
        $user_id = $_SESSION['user_id'];

        $stmt = $db->prepare("INSERT INTO comments (post_id, user_id, comment, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $post_id, $user_id, $comment);
        $stmt->execute();
    } elseif ($_POST['action'] === 'like_post') {
        $post_id = (int)$_POST['post_id'];
        $user_id = $_SESSION['user_id'];

        $stmt = $db->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE id=id");
        $stmt->bind_param("ii", $post_id, $user_id);
        $stmt->execute();
    }
}

// Fetch posts
$posts = $db->query("SELECT p.id, p.title, p.content, p.created_at, u.username, 
    (SELECT COUNT(*) FROM likes WHERE post_id = p.id) AS like_count
    FROM posts p
    JOIN users u ON p.user_id = u.id
    ORDER BY p.created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>

        <section id="create-post">
            <h2>Create a Post</h2>
            <form method="post">
                <input type="hidden" name="action" value="create_post">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>

                <label for="content">Content:</label>
                <textarea name="content" id="content" required></textarea>

                <button type="submit">Post</button>
            </form>
        </section>

        <section id="posts">
            <h2>All Posts</h2>
            <?php while ($post = $posts->fetch_assoc()): ?>
                <article>
                    <h3><?= htmlspecialchars($post['title']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                    <p>Posted by <?= htmlspecialchars($post['username']) ?> on <?= $post['created_at'] ?></p>
                    <p>Likes: <?= $post['like_count'] ?></p>

                    <form method="post" style="display:inline;">
                        <input type="hidden" name="action" value="like_post">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <button type="submit">Like</button>
                    </form>

                    <section class="comments">
                        <h4>Comments</h4>
                        <?php
                        $stmt = $db->prepare("SELECT c.comment, u.username, c.created_at 
                            FROM comments c
                            JOIN users u ON c.user_id = u.id
                            WHERE c.post_id = ?
                            ORDER BY c.created_at ASC");
                        $stmt->bind_param("i", $post['id']);
                        $stmt->execute();
                        $comments = $stmt->get_result();
                        ?>
                        <?php while ($comment = $comments->fetch_assoc()): ?>
                            <p><strong><?= htmlspecialchars($comment['username']) ?>:</strong> <?= htmlspecialchars($comment['comment']) ?> (<?= $comment['created_at'] ?>)</p>
                        <?php endwhile; ?>

                        <form method="post">
                            <input type="hidden" name="action" value="add_comment">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <label for="comment">Add a comment:</label>
                            <textarea name="comment" required></textarea>
                            <button type="submit">Comment</button>
                        </form>
                    </section>
                </article>
            <?php endwhile; ?>
        </section>
    </main>
</body>
</html>
