<?php

$koneksi =  mysqli_connect("localhost", "root", "", "test");

$result = mysqli_query($koneksi, "SELECT * FROM barang");

// $brg =  mysqli_fetch_row($result); array numerik

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

    <h1>Daftar Mahasiswa</h1>
    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <td>No.</td>
            <td>Aksi</td>
            <td>Harta</td>
            <td>Nama</td>
            <td>Jumlah</td>
            <td>Waktu</td>
            <td>Deskripsi</td>

        </tr>
        <?php $a = 1; ?>
        <?php while ($brg = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $a++ ?></td>
                <td>
                    <a href="">Ubah</a> |
                    <a href="">Hapus</a>
                </td>
                <td><?php echo $brg["harta"] ?></td>
                <td><?php echo $brg["nama"] ?></td>
                <td><?php echo $brg["jumlah"] ?></td>
                <td><?php echo $brg["waktu_dibuat"] ?></td>
                <td><?php echo $brg["deskripsi"] ?></td>
            </tr>

        <?php endwhile; ?>
    </table>


</body>

</html>