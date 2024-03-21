<?php
    session_start();
    if(!isset($_SESSION['username'])){
       header("Location:login.php");
       exit();
    }
    include("header.php");
    include("database.php");
    $query = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 3";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/index_homepage.css">


</head>

    <body>
        <main>
            <div class="feature-image-area">
                <img src="Images/imageBackground.png" alt="Feature Image" style="width: 100%; height: 400px;">
            </div>
            <div class="container mt-5">
                <h2 class="text-center mb-4">Latest Posts</h2>
                <div class="row">
                    <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-3">
                        <div class="hot-topic p-3">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 100))); ?>...</p>
                            <p class="text-muted">Posted by <?php echo htmlspecialchars($row['user']); ?></p>
                            <a href="view_post.php?id=<?php echo $row['id']; ?>" class="stretched-link">Read More</a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <div class="col">
                        <p>No hot topics to display.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="content-area">
                <aside class="categories">
                </aside>

                <section class="other-posts">
                </section>
            </div>

            <div class="older-posts-section">
                <div class="categories-area">
                    <h3>POSTS BY CATEGORY: </h3>
                    <br>
                    <button>Health & Wellness</button>
                    <button>Fitness & Exercise</button>
                    <button>Personal Development</button>
                    <button>Finance & Investing</button>
                    <button>Travel & Destinations</button>
                    <button>Video Games & Gaming Culture</button>
                    <button>Photography & Videography</button>
                    <button>Music & Concerts</button>
                    <button>Art & Design</button>
                    <button>Technology & Gadgets</button>
                </div>

                <div class="older-posts-area">
                    <h3>OLDER POSTS:</h3>
                    <br>
                    <?php
                        $older_posts_query = "SELECT * FROM posts WHERE id ORDER BY created_at DESC";
                        $older_posts_stmt = $conn->prepare($older_posts_query);
                        $older_posts_stmt->execute();
                        $older_posts_result = $older_posts_stmt->get_result();
                        if ($older_posts_result->num_rows > 0):
                            while ($post = $older_posts_result->fetch_assoc()):
                    ?>
                    <div class="older-post">
                        <p><?php echo htmlspecialchars(substr($post['content'], 0, 100)); ?>...</p>
                        <button>READ MORE</button>
                        <p class="posted-by">POSTED BY: <?php echo htmlspecialchars($post['user']); ?></p>
                    </div>
                    <?php
                        endwhile;
                        endif;
                    ?>
                </div>
            </div>
        </main>

        <footer>
            <p>MyBlogPost - Contact Us</p>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="CSS/index_header_style.css">
    <body>
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
