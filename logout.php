<?php
    session_start();
    // Destroy session
    if(session_destroy()) {
        // Redirect to index page
        header("Location: index.php");
        exit();
    }
?>