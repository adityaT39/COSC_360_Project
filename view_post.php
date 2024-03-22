<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit();
    }
?>

<?php
    include("header.php");
    include("database.php");
?>

<?php
// Ensure that an ID is provided
if(!isset($_GET['id'])) {
    echo "No post specified.";
    exit();
}

$post_id = $_GET['id'];
$query = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if(!$post) {
    echo "Post not found.";
    exit();
}
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
    </div>
    <?php
      include("footer.php");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
