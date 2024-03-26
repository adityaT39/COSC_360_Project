<?php
    session_start();
    if(!isset($_SESSION['username'])){
       header("Location:login.php");
       exit();
    }
   include("header.php");
   include("database.php");
?>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_SESSION['username'];
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['text']);
    $category = $conn->real_escape_string($_POST['category']);
    
    // Handle the image upload
    if(isset($_FILES["fileInput"]) && $_FILES["fileInput"]["error"] == 0){
        $allowedTypes = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $fileType = $_FILES["fileInput"]["type"];
        if(!array_key_exists(pathinfo($_FILES["fileInput"]["name"], PATHINFO_EXTENSION), $allowedTypes) || !in_array($fileType, $allowedTypes)){
            die("Error: Please select a valid file format.");
        }
        
        $image = file_get_contents($_FILES["fileInput"]["tmp_name"]);
    } else {

        $image = NULL;
    }

    $sql = "INSERT INTO posts (user, title, content, category, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if(false === $stmt) {
        die("Error in query preparation: " . $conn->error);
    }
    $stmt->bind_param("ssssb", $user, $title, $content, $category, $null);
    $null = NULL;
    $stmt->send_long_data(4, $image);
    
    if ($stmt->execute()) {
        echo "New entry record successfull";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
  }
?>

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
      <link rel="stylesheet" href="CSS/contact_form_style.css">
      <link rel="stylesheet" href="CSS/create_style.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
  </head>
  <body>
    <div class="container my-5">
      <h1 class="mb-4">Create a Post:</h1>
      <form method="POST" action="create.php" enctype="multipart/form-data">
        <div class="form-group">
          <input type="text" id=title-post name="title" placeholder="Title of the Post">
        </div>
        <div class="form-group">
          <textarea class="form-control" name="text" rows="8" placeholder="Enter you text here"></textarea>
        </div>
        <div class="form-group">
          <label for="category">Choose a category:</label>
          <select class="form-control" id="category" name="category">
            <option value="Health & Wellness">Health & Wellness</option>
            <option value="Fitness & Exercise">Fitness & Exercise</option>
            <option value="Personal Development">Personal Development</option>
            <option value="Finance & Investing">Finance & Investing</option>
            <option value="Travel & Destinations">Travel & Destinations</option>
            <option value="Video Games & Gaming Culture">Video Games & Gaming Culture</option>
            <option value="Photography & Videography">Photography & Videography</option>
            <option value="Music & Concerts">Music & Concerts</option>
            <option value="Art & Design">Art & Design</option>
            <option value="Technology & Gadgets">Technology & Gadgets</option>
          </select>
        </div>
        <div class="form-group">
          <label for="fileInput">Attach a file:</label>
          <input type="file" class="form-control-file" id="fileInput" name="fileInput">
        </div>
        <br>
        <button type="submit" id="make-post" name="submit">Make Post</button>
      </form>
    </div>
    <?php
      include("footer.php")
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

<?php 
  $stmt->close();
  $conn->close();
?>