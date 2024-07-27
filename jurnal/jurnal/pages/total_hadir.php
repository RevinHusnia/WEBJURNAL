<?php
include '../partials/header.php';
include '../db/db.php';

// Retrieve attendance data from the database
$sql = "SELECT * FROM kegiatan";
$result = $conn->query($sql);
?>

<h1>Total Hadir</h1>
<div class="table-container">
    <h2>Data Kehadiran</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal/Hari</th>
                <th>Status</th>
                <th>Minggu ke</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo date('d/m/Y / l', strtotime($row['tanggal'])); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td><?php echo htmlspecialchars($row['minggu_ke']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../partials/footer.php'; ?>