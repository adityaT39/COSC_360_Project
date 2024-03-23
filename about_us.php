<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:login.php");
        exit();
    }
    include("header.php");
    include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>About Us</h1>
        <p class="lead">Insight Globe is a website created from the inspiration of the creators to bring together people worldwide to share ideas about diverse subjects. Founded on the principle that knowledge empowers individuals, we strive to deliver content that enlightens, informs, and inspires. We seek to make people as connected as possible and to be able to engage in friendly discussions. </p>

        <div class="row">
            <div class="col-md-4">
                <h2>Aditya Tripathy</h2>
                <p>[Description of creator 1]</p>
            </div>
            <div class="col-md-4">
                <h2>João Bolsonaro</h2>
                <p>[Description of creator 2]</p>
            </div>
            <div class="col-md-4">
                <h2>Silvio Carvalho</h2>
                <p>Economics major fourth year-student with experience in financial planning and analysis, applying excel to financial models and financial forecasting, and technical skills in Java, Python, SQL, and R studio. Undertook this website as a project and for applying CSS, PHP, and HTML skills.
</p>
            </div>
        </div>
    </div>
    <?php
            include("footer.php");
        ?>
    <link rel="stylesheet" href="CSS/index_header_style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
