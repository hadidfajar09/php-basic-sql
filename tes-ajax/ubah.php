<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: loginsistem/login.php");
    exit;
}

require_once "functions.php";

$id = $_GET["id"];

$brg = query("SELECT * FROM barang WHERE id = $id")[0];


if (isset($_POST["ubah"])) {
    if (ubah($_POST) > 0) {
        echo "<script> 
            alert('Data berhasil diubah');
            document.location.href = 'index2.php';
        </script>";
    } else {
        echo "<script> 
        alert('GAGAL diubah');
        document.location.href = 'index2.php';
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
    <title>Edit Barang</title>
</head>

<body>

    <h1>Edit barang</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $brg["id"] ?>">
        <input type="hidden" name="gambarLama" value="<?php echo $brg["gambar"] ?>">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" value="<?php echo $brg["nama"] ?>">
            </li>
            <li>
                <label for="harta">Harta : </label>
                <input type="text" name="harta" id="harta" value="<?php echo $brg["harta"] ?>">
            </li>
            <li>
                <label for="jumlah">Jumlah : </label>
                <input type="text" name="jumlah" id="jumlah" value="<?php echo $brg["jumlah"] ?>">
            </li>
            <li>
                <label for="deskripsi">Deskripsi : </label>
                <input type="text" name="deskripsi" id="deskripsi" value="<?php echo $brg["deskripsi"] ?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <img src="img/<?php echo $brg["gambar"]; ?>" alt="" width="60px"> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <br>
            <li>
                <button type="submit" name="ubah">Ubah</button>
            </li>
        </ul>

    </form>
    <button> <a href="index2.php" style="text-decoration: none;">Kembali</a></button>

</body>

</html>