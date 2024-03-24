<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit();
    }

    include("header.php");
    include("database.php");


    $searchKeyword = '';
    $posts = [];
    if (isset($_GET['query']) && $_GET['query'] !== '') {
        $searchKeyword = htmlspecialchars($_GET['query']);


        try {
            $query = $pdo->prepare("SELECT * FROM posts WHERE title LIKE :keyword OR content LIKE :keyword");
            $query->bindValue(':keyword', '%' . $searchKeyword . '%');
            $query->execute();
            $posts = $query->fetchAll(PDO::FETCH_ASSOC);

            if (empty($posts)) {
                
            }
        } catch (PDOException $e) {
            echo 'Query error: ' . $e->getMessage();
        }
       
    } else {
        
    }

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Search Results</title>
        <meta name="description" content="Search results page">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="CSS/style.css">
        <link rel="stylesheet" href="CSS/header_style.css">
        <link rel="stylesheet" href="CSS/result_style.css">
        <link rel="stylesheet" href="CSS/contact_form_style.css">
    </head>
    <body>
    <div class="container mt-5">
        <h2 class="mb-4">Search Results for "<?php echo htmlspecialchars($searchKeyword); ?>"</h2>
        <?php if (!empty($posts)): ?>
            <div class="row">
                <?php foreach ($posts as $post): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars(substr($post['content'], 0, 100)) . '...'; ?></p>
                                <a href="view_post.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Read more</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No posts found matching your criteria.</p>
        <?php endif; ?>
    </div>
    <?php include("footer.php");?>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
<?php
    $conn->close();
?>
