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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insight Globe | Login</title>
    <meta name="description" content="Login to your account">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg" style="width: 22rem;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login</h3>
                
                <?php if(isset($fmsg)) { ?>
                    <div class="alert alert-danger"><?php echo $fmsg; ?></div>
                <?php } ?>

                <form method="post" action="login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class='bx bxs-user'></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Username" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon2"><i class='bx bxs-lock-alt'></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Password" aria-describedby="basic-addon2" required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember Me</label>
                        </div>
                        <a href="#">Forgot Password?</a>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <span>Don't have an account? </span><a href="register.php">Register Here</a>
                </div>
            </div>
        </div>
    </div>
    <?php
        include("footer_index.php");
    ?>
    <link rel="stylesheet" href="CSS/index_header_style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
