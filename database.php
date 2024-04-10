<?php

    $db_server = "localhost";
    $db_user = "65268641";
    $db_pass = "65268641";
    $db_name = "db_65268641";
    $conn = "";
    $pdo = new PDO('mysql:host=localhost;dbname=db_65268641', '65268641', '65268641');

    try {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        if (!$conn) {
            throw new Exception("Could not connect to the database");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    }

?>