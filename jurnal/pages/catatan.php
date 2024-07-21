<?php
include '../partials/header.php';
include '../db/db.php';

// Retrieve notes from the database
$sql = "SELECT * FROM catatan";
$result = $conn->query($sql);
?>

<h1>Catatan</h1>
<div class="card-container">
    <?php while($row = $result->fetch_assoc()): ?>
    <div class="card">
        <h2><?php echo date('l, d/m/Y', strtotime($row['tanggal'])); ?></h2>
        <p><?php echo htmlspecialchars($row['catatan']); ?></p>
    </div>
    <?php endwhile; ?>
</div>

<?php include '../partials/footer.php'; ?>
