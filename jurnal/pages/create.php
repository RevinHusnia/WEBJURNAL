<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Hapus sesi login saat halaman di-refresh
if (!isset($_SESSION['refresh'])) {
    $_SESSION['refresh'] = true;
} else {
    unset($_SESSION['loggedin']);
    unset($_SESSION['refresh']);
    header("Location: login.php");
    exit;
}

include '../partials/header.php';
include '../db/db.php';

// Handle form submission to save notes
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];
    $minggu_ke = $_POST['minggu_ke'];
    $kegiatan = $_POST['kegiatan'];
    $jumlahKegiatan = $_POST['jumlahkegiatan'];
    $catatan = $_POST['catatan'];

    $stmt = $conn->prepare("INSERT INTO catatan (tanggal, catatan) VALUES (?, ?)");
    $stmt->bind_param("ss", $tanggal, $catatan);
    $stmt->execute();

    $stmt = $conn->prepare("INSERT INTO kegiatan (nama, tanggal, status, minggu_ke, kegiatan, jumlahkegiatan) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nama, $tanggal, $status, $minggu_ke, $kegiatan, $jumlahKegiatan);
    $stmt->execute();
}
?>

<h1>Create New Entry</h1>
<form method="POST">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" required>
    <br>
    <label for="tanggal">Tanggal:</label>
    <input class="tanggal" type="date" id="tanggal" name="tanggal" required>
    <br>
    <label for="status">Status:</label>
    <select id="status" name="status" required>
        <option value="Hadir">Hadir</option>
        <option value="Tidak Hadir">Tidak Hadir</option>
    </select>
    <br>
    <label for="minggu_ke">Minggu ke:</label>
    <input type="number" id="minggu_ke" name="minggu_ke" required>
    <br>
    <label for="kegiatan">Kegiatan:</label>
    <input type="text" id="kegiatan" name="kegiatan" required>
    <br>
    <label for="jumlahkegiatan">Jumlah Kegiatan:</label>
    <input type="text" id="jumlahkegiatan" name="jumlahkegiatan" required>
    <br>
    <label for="catatan">Catatan:</label>
    <textarea id="catatan" name="catatan" required></textarea>
    <br>
    <button type="submit">Simpan</button>
</form>

<?php include '../partials/footer.php'; ?>
