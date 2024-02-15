<?php


$conn = mysqli_connect("localhost", "root", "", "akademik23");



function loadData($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $mhs = [];
    while($mahasiswa = mysqli_fetch_assoc($result) ) {
        $mhs[] = $mahasiswa;
    }

    return $mhs;
    

}


function tambahData($data){
    global $conn;
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $jk = htmlspecialchars($data["jenis_kelamin"]);
    if($jk == "laki-laki"){
        $jk = "l";
    }else{
        $jk = "p";
    }
    $jurusan = $data["jurusan"];
    $split = explode(" - ", $jurusan);
    $namaJurusan = $split[0];
    $kode_jurusan = $split[1];  

    if($nim != null && $nama !=     null){
        // insert data ke tabel mahasiswa
        mysqli_query($conn, "INSERT INTO mahasiswa VALUES('$nim', '$nama', '$jk', '$kode_jurusan')");
    
        // mengembalikan nilai 1 jika data berhasil di tambah & mengembalikan nilai -1 jika data gagal di tambah
        return mysqli_affected_rows($conn);
    }else{
        return -1;
    }

}


function hapusData($nim){
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim=$nim");
    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);

}



function updateData($data){
    global $conn;
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $jk = htmlspecialchars($data["jenis_kelamin"]);
    if($jk == "laki-laki"){
        $jk = "l";
    }else{
        $jk = "p";
    }
    $jurusan = $data["jurusan"];
    $split = explode(" - ", $jurusan);
    $namaJurusan = $split[0];
    $kode_jurusan = $split[1];

    // insert data ke tabel mahasiswa
    mysqli_query($conn, "UPDATE mahasiswa SET nama = '$nama', jk = '$jk', kd_jurusan = '$kode_jurusan' WHERE nim = '$nim'");

    // mengembalikan nilai 1 jika data berhasil di tambah & mengembalikan nilai -1 jika data gagal di tambah
    return mysqli_affected_rows($conn);

}


function register($data){
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirmPass = mysqli_real_escape_string($conn, $data["confirmPassword"]);

    // cek apakah username sudah ada di database atau belum
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    // jika username sudah ada maka mysqli_fetch_assoc($result["username:]) akan menghasilkan true
    if(mysqli_fetch_assoc($result)){
        echo "
            <script>
                alert('Username sudah terdaftar!');
            </script>
        ";
        return false;
    }

    // cek korfirmasi password
    if($password !== $confirmPass){
        echo "
        <script>
        alert('Konfirmasi password tidak sesuai');
        </script>
        ";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);


}




?>