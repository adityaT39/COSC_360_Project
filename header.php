<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insight Globe</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/header_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboard.php">
                    <img src="Images/Logo.svg" alt="Logo" style="max-width: 150px; max-height: 100px;">
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="about_us.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="create.php">Create</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="view_posts.php">Your Posts</a>
                        </li>
                    </ul>
                    <a href="profile.php" class="me-2" role="button"><i class="bi bi-person-fill"></i></a>
                    <span class="navbar-text me-3">
                        Welcome, <?= htmlspecialchars($_SESSION['username']); ?>
                    </span>
                    <form class="d-flex align-items-center" id="search-form" action="search_results.php" method="get">
                        <input class="form-control me-2 search-bar-custom" name="query" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn search-button-custom" type="submit">
                            <span class="material-icons">Search</span>
                        </button>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>


