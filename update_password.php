<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['newPassword'])) {
    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
    $currentUsername = $_SESSION['username'];
    
    $query = "UPDATE users SET password = ? WHERE user = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $newPassword, $currentUsername);

    if ($stmt->execute()) {
        echo "Password updated successfully.";
        header("Location: profile.php");
    } else {
        echo "Error updating password: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
