<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="/index.php" class="nav-link"><span class="nav-text">Index</span></a></li>
                <li><a href="/pages/home.php" class="nav-link"><span class="nav-text">Home</span></a></li>
                <li><a href="/pages/total_hadir.php" class="nav-link"><span class="nav-text">Total Hadir</span></a></li>
                <li><a href="/pages/kegiatan.php" class="nav-link"><span class="nav-text">Kegiatan</span></a></li>
                <li><a href="/pages/catatan.php" class="nav-link"><span class="nav-text">Catatan</span></a></li>
                <li><a href="/pages/create.php" class="nav-link"><span class="nav-text">Create</span></a></li>
                <li><a href="/pages/login.php" class="nav-link"><span class="nav-text">Administrator</span></a></li>
            </ul>
        </div>
        <div class="main-content">
            <? include '../pages/catatan.php'; ?>