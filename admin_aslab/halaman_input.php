<?php include("inc_header.php"); ?>
<?php
$Praktikan  =   "";
$NRP        =   "";
$Nilai      =   "";
$error      =   "";
$sukses     =   "";

if (isset($_POST['simpan'])) {
    $Praktikan = $_POST["Praktikan"];
    $NRP = $_POST["NRP"];
    $Nilai = $_POST["Nilai"];

    if ($Praktikan == '' or $NRP == '' or $Nilai == '') {
        $error = "Silahkan masukkan semua data (Nama, NRP, Nilai)";
    }

    if (empty($error)) {
        $sql1 = "INSERT INTO nilaipraktikum (Praktikan, NRP, Nilai) VALUES ('$Praktikan', '$NRP', '$Nilai')";
        $q1 = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses = "Data berhasil dimasukkan";
        } else {
            $error = "Data gagal dimasukkan";
        }
    }
}

?>
<h1>Halaman Admin Input Data</h1>
<div class="mb-3 row">
    <a href="halaman.php">
        << Kembali ke halaman admin</a>
</div>
<?php
if ($sukses) {
    ?>
    <div class="alert alert-success" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>
</div>
<?php
if ($error) {
    ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
    </div>
<?php
}
?>
<form action="" method="post">
    <div class="mb-3 row">
        <label for="Praktikan" class="col-sm-2 col-form-label">Praktikan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="Praktikan" value="<?php echo $Praktikan ?>" name="Praktikan">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="NRP" class="col-sm-2 col-form-label">NRP</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="NRP" value="<?php echo $NRP ?>" name="NRP">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="Nilai" class="col-sm-2 col-form-label">Nilai</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="Nilai" value="<?php echo $Nilai ?>" name="Nilai">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" class="btn btn-primary" value="Simpan Data" />
        </div>
    </div>
</form>
<?php include("inc_footer.php"); ?>