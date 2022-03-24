<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: loginsistem/login.php");
    exit;
}

require_once "functions.php";

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "<script>  
    alert('Data berhasil dihapus');
    document.location.href = 'index2.php';
</script>";
} else {
    echo "<script> 
    alert('Data gagal dihapus');
    document.location.href = 'index2.php';
</script>";
}
