<?php
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


    $sql = "INSERT INTO catatan (tanggal, catatan) VALUES ('$tanggal', '$catatan')";
    $conn->query($sql);

    $sql = "INSERT INTO kegiatan (nama, tanggal, status, minggu_ke, kegiatan) VALUES ('$nama', '$tanggal', '$status', '$minggu_ke', '$kegiatan')";
    $conn->query($sql);
}
?>

<h1>Create New Entry</h1>
<form method="POST">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" required>
    <br>
    <label for="tanggal">Tanggal:</label>
    <input type="date" id="tanggal" name="tanggal" required>
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
    <br>
    <label for="kegiatan">Jumlah Kegiatan:</label>
    <input type="text" id="jumlahkegiatan" name="jumlahkegiatan" required>
    <br>
    <label for="catatan">Catatan:</label>
    <textarea id="catatan" name="catatan" required></textarea>
    <br>
    <button type="submit">Simpan</button>
</form>

<?php include '../partials/footer.php'; ?>
