<?php

usleep(500000);
require_once "../functions.php";

$keyword = $_GET["keyword"];

$query = "SELECT * FROM barang WHERE nama LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'";

$barang = query($query);

?>


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
    <?php $a = 1; ?>
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