<?php
include 'koneksi.php';
session_start();  


$notif_type = "";
$notif_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $namabayi = $_POST['namabayi'];
    $tanggallahir = $_POST['tanggallahir'];
    $beratlahir = $_POST['beratlahir'];
    $panjanglahir = $_POST['panjanglahir'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $namaayah = $_POST['namaayah'];
    $namaibu = $_POST['namaibu'];

    $result = $conn->query("SELECT COUNT(*) as total FROM tbkelahiran");
    $row = $result->fetch_assoc();
    $nextId = $row['total'] + 1;
    $kodekelahiran = "KL" . str_pad($nextId, 3, "0", STR_PAD_LEFT);

 
    $stmt = $conn->prepare("INSERT INTO tbkelahiran (kodekelahiran, namabayi, tanggallahir, beratlahir, panjanglahir, jeniskelamin, namaayah, namaibu) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssissss", $kodekelahiran, $namabayi, $tanggallahir, $beratlahir, $panjanglahir, $jeniskelamin, $namaayah, $namaibu);

    if ($stmt->execute()) {
      
        $_SESSION['notif_type'] = "success";
        $_SESSION['notif_message'] = "Data kelahiran berhasil disimpan dengan kode: $kodekelahiran";

      
        header("Location: master.php");
        exit;
    } else {
      
        $_SESSION['notif_type'] = "error";
        $_SESSION['notif_message'] = "Gagal menyimpan data kelahiran: " . $stmt->error;
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Kelahiran</title>
    <link rel="stylesheet" type="text/css" href="stylestambah.css">
</head>
<body>

    <div class="container">
        <h1>Tambah Data Kelahiran</h1>

      
        <?php if (isset($notif_type)): ?>
            <div class="notif <?php echo $notif_type; ?>">
                <?php echo $notif_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="tambah.php">
            <div class="form-group">
                <label for="namabayi">Nama Bayi:</label>
                <input type="text" name="namabayi" id="namabayi" required>
            </div>

            <div class="form-group">
                <label for="tanggallahir">Tanggal Lahir:</label>
                <input type="date" name="tanggallahir" id="tanggallahir" required>
            </div>

            <div class="form-group">
                <label for="beratlahir">Berat Lahir (kg):</label>
                <input type="number" step="0.01" name="beratlahir" id="beratlahir" required>
            </div>

            <div class="form-group">
                <label for="panjanglahir">Panjang Lahir (cm):</label>
                <input type="number" step="0.1" name="panjanglahir" id="panjanglahir" required>
            </div>

            <div class="form-group">
                <label for="jeniskelamin">Jenis Kelamin:</label>
                <select name="jeniskelamin" id="jeniskelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="namaayah">Nama Ayah:</label>
                <input type="text" name="namaayah" id="namaayah" required>
            </div>

            <div class="form-group">
                <label for="namaibu">Nama Ibu:</label>
                <input type="text" name="namaibu" id="namaibu" required>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">Simpan</button>
                <a href="master.php" class="back-btn">Kembali ke Daftar Data</a>
            </div>
        </form>
    </div>

</body>
</html>
