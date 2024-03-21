<?php
    session_start();
    if(!isset($_SESSION['username'])){
       header("Location:login.php");
       exit();
    }
    include("header.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insight Globe</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/header_style.css">
</head>
<body>
    <div class="banner">
        <div class="slogan">
            <h1>Your Slogan Goes Here</h1>
            <p>A brief description or additional information</p>
        </div>
    </div>
    <footer class="footer text-center">
        &copy; <?php echo date("Y"); ?> Insight Globe. All rights reserved.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
