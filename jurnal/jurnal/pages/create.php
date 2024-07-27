<?php
session_start();

// Periksa apakah pengguna sudah login dan memiliki peran administrator
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['role']) || $_SESSION['role'] !== 'administrator') {
    header("Location: login.php");
    exit;
}

include '../partials/header.php';
include '../db/db.php';

$successMessage = '';

// Handle form submission to save notes
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];
    $minggu_ke = $_POST['minggu_ke'];
    $kegiatan = $_POST['kegiatan'];
    $jumlahKegiatan = $_POST['jumlahkegiatan'];
    $catatan = $_POST['catatan'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert into catatan table
        $stmt = $conn->prepare("INSERT INTO catatan (tanggal, catatan) VALUES (?, ?)");
        $stmt->bind_param("ss", $tanggal, $catatan);
        $stmt->execute();
        
        // Insert into kegiatan table
        $stmt = $conn->prepare("INSERT INTO kegiatan (nama, tanggal, status, minggu_ke, kegiatan, jumlahkegiatan) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nama, $tanggal, $status, $minggu_ke, $kegiatan, $jumlahKegiatan);
        $stmt->execute();

        // Commit transaction
        $conn->commit();

        // Set success message
        $successMessage = "Data berhasil disimpan.";
    } catch (Exception $e) {
        // Rollback transaction if there was an error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>

<h1>Create New Entry</h1>
<?php if ($successMessage): ?>
    <p style="color: green;"><?php echo $successMessage; ?></p>
<?php endif; ?>
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
