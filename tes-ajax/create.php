<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: loginsistem/login.php");
    exit;
}

require_once "functions.php";

if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script> 
            alert('Data berhasil ditambahkan');
            document.location.href = 'index2.php';
        </script>";
    } else {
        echo "<script> 
        alert('GAGAL');
        document.location.href = 'create.php';
    </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
</head>

<body>

    <h1>Tambah barang</h1>

    <form action="" method="POST" enctype="multipart/form-data">

        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="harta">Harta : </label>
                <input type="text" name="harta" id="harta" required>
            </li>
            <li>
                <label for="jumlah">Jumlah : </label>
                <input type="text" name="jumlah" id="jumlah" required>
            </li>
            <li>
                <label for="deskripsi">Deskripsi : </label>
                <input type="text" name="deskripsi" id="deskripsi" required>
            </li>
            <li>
                <label for="deskripsi">Gambar : </label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>

    </form>

    <button> <a href="index2.php" style="text-decoration: none;">Kembali</a></button>


</body>

</html>