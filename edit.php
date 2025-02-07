<?php
include 'koneksi.php';


$kodekelahiran = $_GET['kodekelahiran'];


$result = $conn->query("SELECT * FROM tbkelahiran WHERE kodekelahiran = '$kodekelahiran'");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $namabayi = $_POST['namabayi'];
    $tanggallahir = $_POST['tanggallahir'];
    $beratlahir = $_POST['beratlahir'];
    $panjanglahir = $_POST['panjanglahir'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $namaayah = $_POST['namaayah'];
    $namaibu = $_POST['namaibu'];

    $stmt = $conn->prepare("UPDATE tbkelahiran SET namabayi = ?, tanggallahir = ?, beratlahir = ?, panjanglahir = ?, jeniskelamin = ?, namaayah = ?, namaibu = ? WHERE kodekelahiran = ?");
    $stmt->bind_param("ssssssss", $namabayi, $tanggallahir, $beratlahir, $panjanglahir, $jeniskelamin, $namaayah, $namaibu, $kodekelahiran);

    if ($stmt->execute()) {
        
        header("Location: master.php?success=1");
        exit;
    } else {
        echo "<p>Gagal memperbarui data kelahiran: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Kelahiran</title>
    <link rel="stylesheet" type="text/css" href="stylesedit.css">
</head>
<body>

    <div class="container">
        <h1>Edit Data Kelahiran</h1>

        <form method="POST" action="edit.php?kodekelahiran=<?php echo $kodekelahiran; ?>">
            <label>Nama Bayi:</label>
            <input type="text" name="namabayi" value="<?php echo htmlspecialchars($row['namabayi']); ?>" required><br>

            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggallahir" value="<?php echo htmlspecialchars($row['tanggallahir']); ?>" required><br>

            <label>Berat Lahir (kg):</label>
            <input type="number" name="beratlahir" value="<?php echo htmlspecialchars($row['beratlahir']); ?>" required><br>

            <label>Panjang Lahir (cm):</label>
            <input type="number" name="panjanglahir" value="<?php echo htmlspecialchars($row['panjanglahir']); ?>" required><br>

            <label>Jenis Kelamin:</label>
            <select name="jeniskelamin" required>
                <option value="Laki-laki" <?php echo ($row['jeniskelamin'] === 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="Perempuan" <?php echo ($row['jeniskelamin'] === 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
            </select><br>

            <label>Nama Ayah:</label>
            <input type="text" name="namaayah" value="<?php echo htmlspecialchars($row['namaayah']); ?>" required><br>

            <label>Nama Ibu:</label>
            <input type="text" name="namaibu" value="<?php echo htmlspecialchars($row['namaibu']); ?>" required><br>

            <div class="form-buttons">
                <button type="submit" class="submit-btn">Perbarui Data</button>
                <a href="master.php" class="back-btn">Kembali ke Daftar Data</a>
            </div>
        </form>

        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="success-message">
                <p>Data berhasil diperbarui!</p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
