<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "cosc_360_db";
    $conn = "";

    try {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        if (!$conn) {
            throw new Exception("Could not connect to the database");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    }

?>
