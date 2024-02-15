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
$tambah_class = ($current_page == 'tambah.php') ? 'active' : '';

// load data jurusan
$jurusan = loadData("SELECT * FROM jurusan");



if(isset($_POST["tambah"])){

    if (tambahData($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambah!');
                document.location.href = 'index.php';
            </script>
        ";
    }else{
        echo "
        <script>
            alert('Data gagal ditambah!');
            document.location.href = 'index.php';
        </script>
    ";
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

    <title>Tambah Data Mahasiswa</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?= $tambah_class ?>">
                    <a class="nav-link" href="#">Tambah</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <br>
    <br>

    <div class="container-fluid">
        <div class="col-md-5 offset-md-3">
            <form action="" method="post">
                <div class="form-group row">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                        <input type="text" name="nim" class="form-control" id="nim" placeholder="NIM" require>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" require>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki"
                                    value="laki-laki" checked>
                                <label class="form-check-label" for="laki-laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                    value="perempuan">
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <label class="col-2 col-form-label" for="inlineFormCustomSelectPref">Jurusan</label>
                    <div class="col-10">
                        <select name="jurusan" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                            <?php foreach ($jurusan as $j) : ?>
                            <option value="<?= $j["jurusan"] . " - " . $j["kd_jurusan"] ?>">
                                <?= $j["jurusan"] . " - " . $j["kd_jurusan"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2 text-right">
                        <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                    </div>
            </form>
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