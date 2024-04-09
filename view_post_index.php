<?php
include("header_index.php");
include("database.php");
if (!isset($_GET['id']) && !isset($_POST['post_id'])) {
    echo "No post specified.";
    exit();
}


$post_id = $_GET['id'] ?? $_POST['post_id'] ?? null;


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
            <?php if ($post['image']): ?>
                <div class="mt-3">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($post['image']); ?>" alt="Post Image" style="max-width: 100%; height: auto;">
                </div>
            <?php endif; ?>
            <p class="card-text"><small class="text-muted">Category: <?php echo htmlspecialchars($post['category']); ?></small></p>
        </div>
    </div>
 
    <div class="mt-4 comments-section">
        <h3>Comments:</h3>
        <!-- Comments will be inserted here -->
    </div>
</div>

<?php include("footer_index.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
        function fetchComments() {
            const postId = <?php echo json_encode($post_id); ?>;
            fetch('post_comment.php?post_id=' + postId)
            .then(response => response.json())
            .then(comments => {
                const commentsSection = document.querySelector('.comments-section');
                commentsSection.innerHTML = '';
                if (comments.length === 0) {
                    commentsSection.innerHTML = '<p>No comments yet. Be the first to comment!</p>';
                } else {
                    comments.forEach(comment => {
                        const commentElement = document.createElement('div');
                        commentElement.classList.add('card', 'mb-3');
                        commentElement.innerHTML = `
                            <div class="card-body">
                                <h5 class="card-title">${comment.username}</h5>
                                <p class="card-text">${comment.comment}</p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Posted on ${comment.created_at}
                                    </small>
                                </p>
                            </div>
                        `;
                        commentsSection.appendChild(commentElement);
                    });
                }
            })
            .catch(error => console.error('Error fetching comments:', error));
        }

        fetchComments();

        setInterval(fetchComments, 3000);
    </script>
</body>
</html>

<?php
$stmt->close();
$comments_stmt->close();
$conn->close();
?>
