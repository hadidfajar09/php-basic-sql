<?php


$koneksi =  mysqli_connect("localhost", "root", "", "test");


function query($query)
{
    global $koneksi;

    $result = mysqli_query($koneksi, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data)
{
    global $koneksi;

    if (isset($data["submit"])) {
        $nama = $data["nama"];
        $harta = $data["harta"];
        $jumlah = $data["jumlah"];
        $deskripsi = $data["deskripsi"];
        $waktu = date('Y-m-d H:i:s');

        //upload
        $gambar = upload();
        if (!$gambar) {
            return false;
        }

        $query = "INSERT INTO barang 
    VALUES 
    ('','$harta','$nama','$jumlah','$waktu','$deskripsi','$gambar'
    
    )";

        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $size = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error == 4) {
        echo "<script> 
        alert('Upload Gambar Dulu')
        </script>";
        return false;
    }

    $extensiValid = ['jpg', 'jpeg', 'png'];
    $extensiGambar = explode('.', $namaFile);
    $extensiGambar = strtolower(end($extensiGambar));

    if (!in_array($extensiGambar, $extensiValid)) {
        echo "<script> 
        alert('Upload Extensi Gambar')
        </script>";
        return false;
    }

    if ($size > 1000000) {
        echo "<script> 
        alert('Gambar size terlalu besar')
        </script>";
        return false;
    }
    $namaFileBaru = uniqid();
    $namaFileBaru .= ',';
    $namaFileBaru .= $extensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM barang WHERE id = $id");

    return mysqli_affected_rows($koneksi);
}

function ubah($data)
{
    global $koneksi;

    if (isset($data["submit"])) {
        $id = $data["id"];
        $nama = $data["nama"];
        $harta = $data["harta"];
        $jumlah = $data["jumlah"];
        $deskripsi = $data["deskripsi"];
        $gambar_lama = $data["gambarLama"];

        if ($_FILES['gambar']['error'] == 4) {
            $gambar = $gambar_lama;
        } else {
            $gambar = upload();
        }


        $query = "UPDATE barang SET 
            nama = '$nama',
            harta = '$harta',
            jumlah = '$jumlah',
            deskripsi = '$deskripsi',
            gambar = '$gambar', 
            WHERE id = $id
        ";

        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}

function cari($keyword)
{
    $query = "SELECT * FROM barang WHERE nama LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'";

    return query($query);
}

function registrasi($data)
{
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    $hasil =  mysqli_query($koneksi, "SELECT username FROM pengguna where username = '$username'");

    if (mysqli_fetch_assoc($hasil)) {
        echo
        "<script>
            alert('Username Telah terdaftar');
            </script>
        ";

        return false;
    }

    if ($password !== $password2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai');
            </script>
        ";

        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);


    mysqli_query(
        $koneksi,
        "INSERT INTO pengguna VALUES 
        (
        '','$username','$password')
        "
    );

    return mysqli_affected_rows($koneksi);
}
