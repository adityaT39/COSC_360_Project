<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
    exit();
}
include("header.php");
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_comment'])) {
    $comment_text = $conn->real_escape_string($_POST['comment']);
    $username = $_SESSION['username'];

    $comment_stmt = $conn->prepare("INSERT INTO comments (post_id, username, comment) VALUES (?, ?, ?)");
    $comment_stmt->bind_param("iss", $post_id, $username, $comment_text);
    $comment_stmt->execute();
    $comment_stmt->close();
    header("Location: view_post.php?id=$post_id");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <div class="mt-4">
            <form method="post" action="" id="commentForm">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <div class="mb-3">
                    <label for="comment" class="form-label">Leave a comment:</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <button type="submit" name="submit_comment" class="btn btn-primary">Post Comment</button>
            </form>
        </div>

        <div class="mt-4 comments-section">
            <h3>Comments:</h3>
             <!-- Comments will be inserted here -->
        </div>
    </div>

    <?php include("footer.php"); ?>

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
