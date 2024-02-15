<?php
session_start();

if(!$_SESSION["login"]){
    header("Location: login.php");
    exit;
}

require 'functions.php';


$nim = $_GET["nim"];


if(hapusData($nim) > 0){
    echo "
    <script>
        alert('Data berhasil dihapus!');
        document.location.href = 'index.php';
    </script>
";
}else{
    echo "
    <script>
        alert('Data gagal dihapus!');
        document.location.href = 'index.php';
    </script>
";
}


?>