<?php
include 'koneksi.php';


if (isset($_GET['kodekelahiran'])) {
    $kodekelahiran = $_GET['kodekelahiran'];

  
    $stmt = $conn->prepare("DELETE FROM tbkelahiran WHERE kodekelahiran = ?");
    $stmt->bind_param("s", $kodekelahiran); 

    if ($stmt->execute()) {
        echo "Data berhasil dihapus!";
       
        header("Location: master.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $stmt->error;
    }


    $stmt->close();
} else {
    echo "Kode kelahiran tidak ditemukan.";
}
?>
