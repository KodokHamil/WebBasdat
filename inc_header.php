<?php 
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penilaian Praktikum</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href=''>SMBD FINAL PROJECT</a></div>
            <a href="#" class="tombol-menu">
                <span class="garis"></span>
                <span class="garis"></span>
                <span class="garis"></span>
            </a>
            <div class="menu">
                <ul>
                    <li><a href="http://localhost/WebBasdat">Home</a></li>
                    <!-- didalam #praktikum terdapat praktikan,kelompok,modul -->
                    <li><a href="jadwal.php">Jadwal</a></li>
                    <li><a href="perencanaan.php">Perencanaan</a></li>


                    <li>
                    <?php if(isset($_SESSION['admin_nama_lengkap'])){
                        echo "<a href='".url_dasar()."/admin_aslab/halaman.php'>Halaman Admin</a> | <a href='".url_dasar()."/ganti_profile.php'>".$_SESSION['admin_nama_lengkap']."</a> | <a href='".url_dasar()."/logout.php'>Logout</a>";
                    }else{?>
                        <a href="login.php" class="tbl-biru">Login</a>
                        <a href="pendaftaran.php" class="tbl-oren">Sign Up</a>
                    <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">