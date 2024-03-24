<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insight Globe</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/header_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="Images/Logo.svg" alt="Logo" style="max-width: 150px; max-height: 100px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto mb-2 mb-lg-0">
                    <a class="nav-link nav-link-custom" href="about_us_index.php">About Us</a>
                    <a class="nav-link nav-link-custom" href="register.php">Register</a>
                    <a class="nav-link nav-link-custom" href="login.php">Login</a>
                    <a class="nav-link nav-link-custom btn btn-warning" href="admin_login.php">Admin</a>
                </div>
                <form class="d-flex align-items-center" id="search-form" action="search_results.php" method="get">
                    <input class="form-control me-2 search-bar-custom" name="query" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn search-button-custom" type="submit">
                        <span class="material-icons">Search</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
