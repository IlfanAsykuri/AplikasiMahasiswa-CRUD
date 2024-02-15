<?php
require 'functions.php';


if(isset($_POST["register"])){

    if(register($_POST)){
        echo "
        <script>
        alert('Registrasi berhasil!');
        </script>
        ";
    }else{
        echo mysqli_error($conn);
    }



}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Register</title>
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
                        <h5 class="d-flex justify-content-center align-items-center">Register Aplikasi Mahasiswa</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="register">Register</button>
                            <p>Sudah punya akun? <a href="login.php">Login</a></p>
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