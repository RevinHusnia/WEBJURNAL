<?php
include '../partials/header.php';
include '../db/db.php';

// Retrieve attendance data from the database
$sql = "SELECT * FROM kegiatan";
$result = $conn->query($sql);
?>

<h1>Total Kegiatan</h1>
<div class="table-container">
    <h2>Data Kegiatan</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal/Hari</th>
                <th>kegiatan</th>
                <th>jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo date('d/m/Y / l', strtotime($row['tanggal'])); ?></td>
                <td><?php echo htmlspecialchars($row['kegiatan']); ?></td>
                <td><?php echo htmlspecialchars($row['jumlahkegiatan']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../partials/footer.php'; ?>
