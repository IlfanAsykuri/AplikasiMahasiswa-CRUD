<?php
session_start();

require 'functions.php';


if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    // cek apakah username ada atau cocok di database
    $result =  mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if(mysqli_num_rows($result) === 1){

        // cek jika password sama dengan password di database
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            $_SESSION["login"] = true;
            header("Location: index.php");
            exit;
        }


    }

    $error = true;


}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Login</title>
    <style>
    .error-message {
        background-color: #dc3545;
        /* Merah */
        color: #fff;
        /* Putih */
        font-style: italic;
        /* Cetak miring */
        padding: 10px;
        border-radius: 5px;
        text-align: center;
    }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="img/Logo Unuja.png" alt="Logo" class="mr-2"
                                style="max-width: 60px; max-height: 60px;">
                        </div>
                        <h5 class="d-flex justify-content-center align-items-center">Login Aplikasi Mahasiswa</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <?php if(isset($error)) : ?>
                            <p class="error-message d-flex justify-content-center align-items-center mt-3">Username atau
                                password salah!</p>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                            <p>Belum punya akun? <a href="register.php">Register</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>