<?php
include("database.php");
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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body>
        <header>
            <a href="index.html"><img id="logo" src="Images/Logo.svg" alt="Logo of the website"></a>
            <nav>
                <ul class="navigation_links">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Create</a></li>
                    <li><a href="#">Login</a></li>
                    <li><a href="register.html">Register</a></li>
                </ul>
            </nav>
            <form action="">
                <div class="search">
                    <span class="search-icon material-symbols-outlined">search</span>
                    <input class="search-bar" type="search" placeholder="Search">
                </div>
            </form>
        </header>
        <div class="register">
            <div class="register-head">
                <h2>Registration</h2>
            </div>
            <form action="register.php" method="post" class="form" id="form">
                <div class="form-control">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Your Username" id="username">
                    <i class="check-icon"><span class="material-symbols-outlined">check</span></i>
                    <i class="error-icon"><span class="material-symbols-outlined">error</span></i>
                    <small>Error Message</small>
                </div>
                <div class="form-control">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Your Email" id="email">
                    <i class="check-icon"><span class="material-symbols-outlined">check</span></i>
                    <i class="error-icon"><span class="material-symbols-outlined">error</span></i>
                    <small>Error Message</small>
                </div>
                <div class="form-control">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" id="password">
                    <i class="check-icon"><span class="material-symbols-outlined">check</span></i>
                    <i class="error-icon"><span class="material-symbols-outlined">error</span></i>
                    <small>Error Message</small>
                </div>
                <div class="form-control">
                    <label>Confirm Password</label>
                    <input type="password" name="password" placeholder="Password" id="password2">
                    <i class="check-icon"><span class="material-symbols-outlined">check</span></i>
                    <i class="error-icon"><span class="material-symbols-outlined">error</span></i>
                    <small>Error Message</small>
                </div>
                <div class="form-control">
                    <label for="profilePicture" class="file-label">
                        <span class="material-symbols-outlined">attach_file</span> Choose Profile Picture
                    </label>
                    <input type="file" id="profilePicture" accept="image/*" class="file-input">
                </div>
                <button>Submit</button>
            </form>
        </div>
    </body>
</html>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        $hash = password_hash($password , PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (user, email, password)
                VALUES ('$username', '$email', '$hash')";
        mysqli_query($conn, $sql);
        echo "You are now registered";
    }

    mysqli_close($conn);
?>