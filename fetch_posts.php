<?php
    include("database.php");

    $query = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 3";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $posts = array();

    while ($row = $result->fetch_assoc()) {
        $posts[] = array(
            'id' => $row['id'],
            'title' => htmlspecialchars($row['title']),
            'content' => htmlspecialchars($row['content']),
            'user' => htmlspecialchars($row['user'])
        );
    }

    header('Content-Type: application/json');
    echo json_encode($posts);
?>
