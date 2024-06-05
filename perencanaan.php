<?php include("inc_header.php") ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
<style>
    h4 {
    font-weight: bold;
    font-size: 30px;
    padding: 10px 0px 10px 0px;
    color: #364f6b;
    width: 100%;
    line-height: 50px;
}

p {
    margin: 10px 0px 10px 0px;
    padding: 10px 0px 10px 0px;
}
</style>
<?php
$Praktikan = "";
$NRP = "";
$Praktikum = "";
$error = "";
$sukses = "";

if (isset($_POST['simpan'])) {
    $Praktikan = $_POST["Praktikan"];
    $NRP = $_POST["NRP"];
    $Praktikum = $_POST["Praktikum"];

    if ($Praktikan == '' or $NRP == '' or $Praktikum == '') {
        $error = "Silahkan masukkan semua data (Nama, NRP, Praktikum)";
    }

    if (empty($error)) {
        $sql1 = "INSERT INTO praktikan (Praktikan, NRP, Praktikum) VALUES ('$Praktikan', '$NRP', '$Praktikum')";
        $q1 = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses = "Data berhasil dimasukkan";
        } else {
            $error = "Data gagal dimasukkan";
        }
    }
}

?>
<h4>Perencanaan Pengambilan Praktikum</h4>
<div class="mb-3 row">
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
        <label for="Praktikan" class="col-sm-2 col-form-label text-end">Praktikan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="Praktikan" value="<?php echo $Praktikan ?>" name="Praktikan">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="NRP" class="col-sm-2 col-form-label text-end">NRP</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="NRP" value="<?php echo $NRP ?>" name="NRP">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="Praktikum" class="col-sm-2 col-form-label text-end">Praktikum</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="Praktikum" value="<?php echo $Praktikum ?>" name="Praktikum">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" class="btn btn-primary" value="Simpan Data" />
        </div>
    </div>
</form>
<?php include("inc_footer.php") ?>