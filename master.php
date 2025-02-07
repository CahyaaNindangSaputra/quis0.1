<?php
include 'koneksi.php';
session_start(); 


$result = $conn->query("SELECT * FROM tbkelahiran");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kelahiran</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

    <div class="container">
        <h1>Data Kelahiran</h1>
        <a href="tambah.php" class="add-data-btn">Tambahkan Data Baru</a>

    
        <?php if (isset($_SESSION['notif_type'])): ?>
            <div class="notif <?php echo $_SESSION['notif_type']; ?>">
                <?php echo $_SESSION['notif_message']; ?>
            </div>
            <?php 
            
            unset($_SESSION['notif_type']);
            unset($_SESSION['notif_message']);
            ?>
        <?php endif; ?>

        <h2>Daftar Data Kelahiran</h2>
        <table>
            <tr>
                <th>Kode Kelahiran</th>
                <th>Nama Bayi</th>
                <th>Tanggal Lahir</th>
                <th>Berat Lahir</th>
                <th>Panjang Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['kodekelahiran']); ?></td>
                    <td><?php echo htmlspecialchars($row['namabayi']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggallahir']); ?></td>
                    <td><?php echo htmlspecialchars($row['beratlahir']); ?></td>
                    <td><?php echo htmlspecialchars($row['panjanglahir']); ?></td>
                    <td><?php echo htmlspecialchars($row['jeniskelamin']); ?></td>
                    <td><?php echo htmlspecialchars($row['namaayah']); ?></td>
                    <td><?php echo htmlspecialchars($row['namaibu']); ?></td>
                    <td>
                        <a href="edit.php?kodekelahiran=<?php echo $row['kodekelahiran']; ?>">Edit</a> | 
                        <a href="hapus.php?kodekelahiran=<?php echo $row['kodekelahiran']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

</body>
</html>
