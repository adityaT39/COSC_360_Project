<?php
include("header_index.php");
include("database.php");

// Check if the post ID is present
if (!isset($_GET['id']) && !isset($_POST['post_id'])) {
    echo "No post specified.";
    exit();
}

// Define post_id depending on the method of the request
$post_id = $_GET['id'] ?? $_POST['post_id'] ?? null;

// Retrieve post details
$query = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "Post not found.";
    exit();
}

// Retrieve existing comments for the post
$comments_query = "SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC";
$comments_stmt = $conn->prepare($comments_query);
$comments_stmt->bind_param("i", $post_id);
$comments_stmt->execute();
$comments_result = $comments_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($post['title']); ?> | Insight Globe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/header_style.css">
    <link rel="stylesheet" href="CSS/view_post_style.css">
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h1>
            <h6 class="text-muted card-subtitle mb-2">Posted on: <?php echo date('F j, Y', strtotime($post['created_at'])); ?></h6>
            <p class="card-text"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            <p class="card-text"><small class="text-muted">Category: <?php echo htmlspecialchars($post['category']); ?></small></p>
        </div>
    </div>
    <!-- Comments Display -->
    <div class="mt-4">
        <h3>Comments:</h3>
        <?php while ($comment = $comments_result->fetch_assoc()): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($comment['username']); ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>
                    <p class="card-text">
                        <small class="text-muted">
                            Posted on <?= date('F j, Y, g:i a', strtotime($comment['created_at'])); ?>
                        </small>
                    </p>
                </div>
            </div>
        <?php endwhile; ?>
        <?php if ($comments_result->num_rows == 0): ?>
            <p>No comments yet. Be the first to comment!</p>
        <?php endif; ?>
    </div>
</div>

<?php include("footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$comments_stmt->close();
$conn->close();
?>
