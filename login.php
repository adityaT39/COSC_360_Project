<?php
require("database.php");

session_start();

include("header_index.php");

if (isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE user='$username'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);

    if ($count == 1){
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $fmsg = "Invalid Password.";
        }
    } else {
        $fmsg = "User does not exist.";
    }
}
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
        <link rel="stylesheet" href="CSS/index_header_style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class="wrapper">
            <form method="post" action="login.php">
                <h1>Login</h1>

                <?php if(isset($fmsg)) { ?>
                    <div class="error-message"><?php echo $fmsg; ?></div>
                <?php } ?>

                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="remember-forgot">
                    <label> <input type="checkbox">Remember Me</label>
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="button">Login</button>
                <div class="register-link">
                    Don't have an account? <a href="register.html">Register Here</a>
                </div>
            </form>
        </div>
    </body>
</html>