<?php
$barang = [
    [
        "produk" => "Mie",
        "harga" => 20000,
        "stok" => 20,
        "gambar" => "1.PNG"
    ],

    [
        "produk" => "Mouse",
        "harga" => 40000,
        "stok" => 10,
        "gambar" => "2.JPG"
    ],
]
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>

<body>
    <h1>Daftar Mahasiswa</h1>
    <ul>
        <?php foreach ($barang as $mhs) : ?>

            <li><img src="img/<?php echo $mhs["gambar"] ?>" width="50px"></li>
            <li><?php echo $mhs["produk"] ?></li>
            <li><?php echo $mhs["harga"] ?></li>
            <li><?php echo $mhs["stok"] ?></li>
            <br>

        <?php endforeach; ?>

    </ul>
</body>

</html>