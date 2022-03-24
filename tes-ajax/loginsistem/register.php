<?php


require_once "../functions.php";

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('User Ditambahkan');
                </script>
                ";
    } else {
        mysqli_error($koneksi);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>

    <style>
        label {
            display: block;
        }

        ul li {
            list-style-type: none;
        }
    </style>
</head>

<body>
    <h1>Registrasi</h1>
    <form action="" method="post">

        <ul>
            <li>
                <label for="username">Username : </label>
                <input type="text" name="username" id="username" required>
            </li>

            <li>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" required>
            </li>

            <li>
                <label for="password2">Konfirmasi Password : </label>
                <input type="password" name="password2" id="password2" required>
            </li>

            <li>
                <button type="submit" name="register">Daftar</button>
            </li>
        </ul>


    </form>

</body>

</html>