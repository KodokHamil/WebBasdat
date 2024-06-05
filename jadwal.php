<?php include("inc_header.php"); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
<?php
$sukses = "";
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
?>
<style>
    h4 {
    font-weight: bold;
    font-size: 40px;
    padding: 10px 0px 10px 0px;
    color: #364f6b;
    width: 100%;
    line-height: 50px;
}

</style>
<h4>Jadwal Praktikum</h4>
<p>
    <a href="jadwal.php">
        <input type="button" class="btn btn-primary" value="Kembali">
    </a>
</p>
<?php
if ($sukses) {
?>
    <div class="alert alert-success" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>
<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Masukkan Kata Kunci" name="katakunci" value="<?php echo $katakunci ?>" />
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="Search" class="btn btn-primary mb-3" />
    </div>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th>Praktikum</th>
            <th>Modul</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Ruangan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqltambahan = "";
        $per_halaman = 10;
        if ($katakunci != '') {
            $array_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($array_katakunci); $x++) {
                $sqlcari[] = "(Praktikum like '%" . $array_katakunci[$x] . "%' or Modul like '%" . $array_katakunci[$x] . "%' or Tanggal like '%" . $array_katakunci[$x] . "%' or Waktu like '%" . $array_katakunci[$x] . "%' or Ruangan like '%" . $array_katakunci[$x] . "%')";
            }
            $sqltambahan = " where " . implode(" or ", $sqlcari);
        }
        $sql1   = "SELECT * FROM jadwal $sqltambahan";
        $page   = isset($_GET['page'])?(int)$_GET['page']:1;
        $mulai  = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
        $q1     = mysqli_query($koneksi,$sql1);
        $total  = mysqli_num_rows($q1);
        $pages  = ceil($total / $per_halaman);
        $nomor  = $mulai + 1;
        $sql1   = $sql1." order by id_jadwal asc limit $mulai,$per_halaman";

        $q1     = mysqli_query($koneksi, $sql1);

        while ($r1 = mysqli_fetch_array($q1)) {
        ?>
            <tr>
                <td><?php echo $nomor++ ?></td>
                <td><?php echo $r1['Praktikum'] ?></td>
                <td><?php echo $r1['Modul'] ?></td>
                <td><?php echo $r1['Tanggal'] ?></td>
                <td><?php echo $r1['Waktu'] ?></td>
                <td><?php echo $r1['Ruangan'] ?></td>
            </tr>
        <?php
        }
        ?>

    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php 
        $cari = isset($_GET['cari'])? $_GET['cari'] : "";

        for($i=1; $i <= $pages; $i++){
            ?>
            <li class="page-item">
                <a class="page-link" href="jadwal.php?katakunci=<?php echo $katakunci?>&cari=<?php echo $cari?>&page=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>
<?php include("inc_footer.php") ?>