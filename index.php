<?php
session_start();

if(!$_SESSION["login"]){
    header("Location: login.php");
    exit;
}

require 'functions.php';

// mendapatkan nama page yang sedang aktif
$current_page = basename($_SERVER['PHP_SELF']);

// mengatur active navbar sesuai nama page yang active
$home_class = ($current_page == 'index.php') ? 'active' : '';

$mahasiswa = loadData("SELECT * FROM mahasiswa AS m JOIN jurusan AS j ON m.kd_jurusan = j.kd_jurusan ORDER BY nim ASC");

if(isset($_POST["search"])){
    $keyword = $_POST["keyword"];
    if($keyword != null){
        $mahasiswa = loadData("SELECT * FROM mahasiswa AS m JOIN jurusan AS j ON m.kd_jurusan = j.kd_jurusan WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%'");
    }else{
        $mahasiswa = loadData("SELECT * FROM mahasiswa AS m JOIN jurusan AS j ON m.kd_jurusan = j.kd_jurusan ORDER BY nim ASC");
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Aplikasi Mahasiswa</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= $home_class ?>">
                    <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tambah.php">Tambah</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="" method="POST">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="search">Search</button>
            </form>
            <a href="logout.php" class="btn btn-danger my-2 my-sm-0" type="submit" name="logout">Logout</a>
        </div>
    </nav>

    <br>
    <br>

    <div class="container-fluid">
        <div class="col-md-8 offset-md-2">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">NIM</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">JENIS KELAMIN</th>
                        <th scope="col">JURUSAN</th>
                        <th scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($mahasiswa as $mhs) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $mhs["nim"] ?></td>
                        <td><?= $mhs["nama"] ?></td>
                        <td>
                            <?php if($mhs["jk"] == "l"){
                                echo "Laki-laki";
                            }else{
                                echo "Perempuan";
                            } ?>
                        </td>
                        <td><?= $mhs["jurusan"] . " - " . $mhs["kd_jurusan"] ?></td>
                        <td>
                            <a href="update.php?nim=<?= $mhs["nim"] ?>" type="button" class="btn btn-primary btn-sm">Update</a>
                            <a href="hapus.php?nim=<?= $mhs["nim"] ?>" type="button" class="btn btn-danger btn-sm"  onclick="return confirm('Apakah anda yakin ingin menghapus data?');">Hapus</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>