<?php
session_start();

if (isset($_POST['Login'])) {
    $user = $_POST['user'];
    $password = $_POST['pass'];

    // Validasi login
    if ($user == "cahya" && $password == "123") {
        //bila password benar 
        $_SESSION['login'] = $user;
        echo "Anda berhasil login.";
        header("Location: master.php"); // Redirect ke halaman form
        exit;
    } else {
        // Tetap di halaman login dengan pesan kesalahan
        header("Location: indexlogin.php");
    }

   
}
?>