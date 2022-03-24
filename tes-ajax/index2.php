<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: loginsistem/login.php");
    exit;
}

require_once "functions.php";

$jumlahDataPerhalaman = 2;
$jumlahData = count(query("SELECT * FROM barang"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

var_dump($halamanAktif);

$barang = query("SELECT * FROM barang LIMIT $awalData, $jumlahDataPerhalaman");

// $brg =  mysqli_fetch_row($result); array numerik

if (isset($_POST["cari"])) {
    $barang = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan array</title>
</head>

<body>

    <a href="loginsistem/logout.php">Logout</a>

    <h1>Daftar Mahasiswa</h1>
    <a href="create.php">Tambah Barang</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" placeholder="Cari barang" size="40" id="keyword">
        <button type="submit" name="cari" id="pencarian">Cari!</button>
    </form>

    <?php if ($halamanAktif != 1) : ?>
        <a href="?halaman=<?= $halamanAktif - 1 ?>">&lt</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>

        <?php if ($i == $halamanAktif) : ?>
            <a href="?halaman=<?= $i ?>" style="font-weight: bold; color: red;"> <?= $i ?> </a>
        <?php else : ?>
            <a href="?halaman=<?= $i ?>"> <?= $i ?> </a>
        <?php endif; ?>

    <?php endfor; ?>

    <?php if ($halamanAktif != $jumlahHalaman) : ?>
        <a href="?halaman=<?= $halamanAktif + 1 ?>">&gt</a>
    <?php endif; ?>



    <br><br>

    <div id="container">



        <table border="1" cellpadding="10" cellspacing="0">

            <tr>
                <td>No.</td>
                <td>Aksi</td>
                <td>Harta</td>
                <td>Nama</td>
                <td>Jumlah</td>
                <td>Waktu</td>
                <td>Deskripsi</td>
                <td>Gambar</td>

            </tr>
            <?php $a = 1 + $awalData; ?>
            <?php foreach ($barang as $brg) : ?>
                <tr>
                    <td><?php echo $a++; ?></td>
                    <td>
                        <a href="ubah.php?id=<?php echo $brg["id"]; ?>">Ubah</a> |
                        <a href="hapus.php?id=<?php echo $brg["id"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
                    </td>
                    <td><?php echo $brg["harta"]; ?></td>
                    <td><?php echo $brg["nama"]; ?></td>
                    <td><?php echo $brg["jumlah"]; ?></td>
                    <td><?php echo $brg["waktu_dibuat"]; ?></td>
                    <td><?php echo $brg["deskripsi"]; ?></td>
                    <td>
                        <img src="img/<?php echo $brg["gambar"]; ?>" alt="" width="60px">

                    </td>
                </tr>

            <?php endforeach; ?>
        </table>

    </div>

    <script type="text/javascript">
        var keyword = document.getElementById('keyword');
        var tombolcari = document.getElementById('pencarian');
        var container = document.getElementById('container');

        //evenet ketika keyword diketik
        keyword.addEventListener('keyup', function() {
            var xhr = new XMLHttpRequest(); //objek ajax

            //cek kesiapan ajax
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    container.innerHTML = xhr.responseText;
                }
            }

            //eksekusi ajax
            xhr.open('GET', 'ajax/coba.php?keyword=' + keyword.value, true);
            xhr.send();

        });
    </script>

</body>

</html>