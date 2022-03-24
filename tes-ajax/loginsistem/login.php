<?php

session_start();

require_once "../functions.php";

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($koneksi, "SELECT username FROM pengguna WHERE id = $id");

    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['username'])) {
        $_SESSION["login"] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: ../index2.php");
    exit;
}

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE username = '$username' ");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            //set session
            $_SESSION["login"] = true;

            if (isset($_POST["remember"])) {
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header('Location: ../index2.php');
            exit;
        }
    }

    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>

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


    <h1>LOGIN</h1>
    <?php if (isset($error)) : ?>
        <p style="color: red; font-style: italic;">Username / Password Slaah</p>

    <?php endif; ?>
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

                <label for="remember">Remember me! <input type="checkbox" name="remember" id="remember"> </label>
            </li>

            <li>
                <button type="submit" name="login">LOGIN</button>
            </li>
        </ul>


    </form>

</body>

</html>