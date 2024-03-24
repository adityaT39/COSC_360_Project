<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['newUsername'])) {
    $newUsername = $_POST['newUsername'];
    $currentUsername = $_SESSION['username'];

    $conn->begin_transaction();

    try {
        $query = "UPDATE users SET user = ? WHERE user = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $newUsername, $currentUsername);
        $stmt->execute();
        $stmt->close();

        $postQuery = "UPDATE posts SET user = ? WHERE user = ?";
        $postStmt = $conn->prepare($postQuery);
        $postStmt->bind_param("ss", $newUsername, $currentUsername);
        $postStmt->execute();
        $postStmt->close();

        $commentQuery = "UPDATE comments SET username = ? WHERE username = ?";
        $commentStmt = $conn->prepare($commentQuery);
        $commentStmt->bind_param("ss", $newUsername, $currentUsername);
        $commentStmt->execute();
        $commentStmt->close();

        $conn->commit();

        $_SESSION['username'] = $newUsername;
        header("Location: profile.php");
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error updating records: " . $e->getMessage();
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
