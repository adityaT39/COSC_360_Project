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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <main>
            <div id="alert-container" style="position: fixed; top: 20px; right: 20px; z-index: 1050;"></div>
            <div class="feature-image-area">
                <img src="Images/aerial-2015.jpg" alt="Feature Image" style="width: 100%; height: 400px;">
            </div>
            <div class="container mt-5">
                <h2 class="text-center mb-4">Latest Posts</h2>
                <div class="row" id="latest-posts-container">
                <!-- Dynamic posts will be appended here -->
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
                    <h3>POSTS BY CATEGORY:</h3>
                    <br>
                    <a href="category_results.php?category=<?php echo urlencode('Health & Wellness'); ?>" class="btn btn-primary">Health & Wellness</a>
                    <br>
                    <a href="category_results.php?category=<?php echo urlencode('Fitness & Exercise'); ?>" class="btn btn-primary">Fitness & Exercise</a>
                    <br>
                    <a href="category_results.php?category=<?php echo urlencode('Finance & Investing'); ?>" class="btn btn-primary">Finance & Investing</a>
                    <br>
                    <a href="category_results.php?category=Personal Development" class="btn btn-primary">Personal Development</a>
                    <br>
                    <a href="category_results.php?category=<?php echo urlencode('Travel & Destinations'); ?>" class="btn btn-primary">Travel & Destinations</a>
                    <br>
                    <a href="category_results.php?category=<?php echo urlencode('Video Games & Gaming Culture'); ?>" class="btn btn-primary">Video Games & Gaming Culture</a>
                    <br>
                    <a href="category_results.php?category=<?php echo urlencode('Photography & Videography'); ?>" class="btn btn-primary">Photography & Videography</a>
                    <br>
                    <a href="category_results.php?category=<?php echo urlencode('Music & Concerts'); ?>" class="btn btn-primary">Music & Concerts</a>
                    <br>
                    <a href="category_results.php?category=<?php echo urlencode('Art & Design'); ?>" class="btn btn-primary">Art & Design</a>
                    <br>
                    <a href="category_results.php?category=<?php echo urlencode('Technology & Gadgets'); ?>" class="btn btn-primary">Technology & Gadgets</a>
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
                        <h3 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h3>
                        <p><?php echo htmlspecialchars(substr($post['content'], 0, 100)); ?>...</p>
                        <a href="view_post.php?id=<?php echo $post['id']; ?>" class="read-more-older">READ MORE</a>
                        <p class="posted-by">POSTED BY: <?php echo htmlspecialchars($post['user']); ?></p>
                    </div>
                    <?php
                        endwhile;
                        endif;
                    ?>
                </div>
            </div>
        </main>
        <?php
            include("footer.php");
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <link rel="stylesheet" href="CSS/index_header_style.css">
        <script src="live_updates.js"></script>
    </body>
</html>