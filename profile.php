<?php
    session_start();
    if(!isset($_SESSION['username'])){
       header("Location:login.php");
       exit();
    }
    include("header.php");
    include("database.php");

    $username = $_SESSION['username'];
    $query = "SELECT user, email, reg_date FROM users WHERE user = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
    } else {
        echo "User not found";
        exit;
    }
    $postQuery = "SELECT title FROM posts WHERE user = ? ORDER BY created_at DESC LIMIT 1";
    $postStmt = $conn->prepare($postQuery);
    $postStmt->bind_param("s", $username);
    $postStmt->execute();
    $postResult = $postStmt->get_result();
    $latestPostTitle = $postResult->num_rows > 0 ? $postResult->fetch_assoc()['title'] : 'No posts found.';
    $stmt->close();
    $conn->close();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="CSS/header_style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/profile_style.css">
</head>
<body>
    <div class="container">
        <div class="profile-container">
            <div class="username">
                <?php echo htmlspecialchars($user['username']); ?>
            </div>
            <div class="info-box">
                <h3>Info/ Edit Info:</h3>
                <p>Username: <?php echo htmlspecialchars($user['user']); ?></p>
                <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                <p>Registration Date: <?php echo htmlspecialchars($user['reg_date']); ?></p>
                <button class="btn">Change Username</button>
                <button class="btn">Change Password</button>
            </div>
            <div class="activity-box">
                <h3>User Activity:</h3>
                <p>Latest Post Title: <?php echo htmlspecialchars($latestPostTitle); ?></p>
                <p>Previous Posts / Replies:</p>
            </div>
        </div>
    </div>
    <?php
        include("footer.php");
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="CSS/index_header_style.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>