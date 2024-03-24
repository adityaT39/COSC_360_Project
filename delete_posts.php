<?php
    session_start();
    if(!isset($_SESSION['username'])){
       header("Location:login.php");
       exit();
    }
    include("header.php");
    include 'database.php'; 

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selectedPosts'])) {
        $postIds = $_POST['selectedPosts'];
        $placeholders = implode(',', array_fill(0, count($postIds), '?'));
        $types = str_repeat('i', count($postIds)); 
        $stmt = $conn->prepare("DELETE FROM posts WHERE id IN ($placeholders)");

        $stmt->bind_param($types, ...$postIds);
        $stmt->execute();
        if($stmt->affected_rows > 0) {
            $message = "Selected posts have been deleted.";
        } else {
            $message = "No posts were deleted.";
        }
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Posts</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <?php if (!empty($message)): ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <h1>Delete Posts</h1>
    <form method="POST" action="">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Content</th>
                    <th scope="col">Category</th>
                    <th scope="col">Select</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT id, user, content, category FROM posts";
                    if ($result = $conn->query($query)) {
                        while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <th scope="row"><?php echo htmlspecialchars($row['id']); ?></th>
                    <td><?php echo htmlspecialchars($row['user']); ?></td>
                    <td><?php echo htmlspecialchars($row['content']); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td>
                        <input type="checkbox" name="selectedPosts[]" value="<?php echo $row['id']; ?>">
                    </td>
                </tr>
                <?php 
                        endwhile;
                        $result->free();
                    }
                ?>
            </tbody>
        </table>
        <button type="submit" name="delete" class="btn btn-danger">Delete Selected Posts</button>
    </form>
</div>

<?php
    include("footer.php");
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
