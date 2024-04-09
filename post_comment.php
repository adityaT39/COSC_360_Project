<?php
session_start();
include("database.php"); 

$post_id = $_GET['post_id'] ?? null;

if (!$post_id) {
    echo json_encode(['error' => 'No post ID provided']);
    exit;
}

$comments_query = "SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC";
$comments_stmt = $conn->prepare($comments_query);
$comments_stmt->bind_param("i", $post_id);
$comments_stmt->execute();
$result = $comments_stmt->get_result();
$comments = [];

while ($comment = $result->fetch_assoc()) {
    $comments[] = [
        'username' => htmlspecialchars($comment['username']),
        'comment' => nl2br(htmlspecialchars($comment['comment'])),
        'created_at' => date('F j, Y, g:i a', strtotime($comment['created_at']))
    ];
}

echo json_encode($comments);

$comments_stmt->close();
$conn->close();
?>
