<?php include("inc_header.php") ?>
<?php
$sukses = "";
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'DELETE') {
    $id = $_GET['ID'];
    $sql1   = "DELETE FROM nilaipraktikum WHERE ID = '$id'";
    $q1     = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Data berhasil dihapus";
    }
}

?>
<h1>Nilai Praktikan</h1>
<p>
    <a href="halaman_input.php">
        <input type="button" class="btn btn-primary" value="Input Data Baru">
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
            <th>Praktikan</th>
            <th>NRP</th>
            <th>Nilai</th>
            <th class="col-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqltambahan = "";
        $per_halaman = 5;
        if ($katakunci != '') {
            $array_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($array_katakunci); $x++) {
                $sqlcari[] = "(Praktikan like '%" . $array_katakunci[$x] . "%' or NRP like '%" . $array_katakunci[$x] . "%' or Nilai like '%" . $array_katakunci[$x] . "%')";
            }
            $sqltambahan = " where " . implode(" or ", $sqlcari);
        }
        $sql1   = "SELECT * FROM nilaipraktikum $sqltambahan";
        $page   = isset($_GET['page'])?(int)$_GET['page']:1;
        $mulai  = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
        $q1     = mysqli_query($koneksi,$sql1);
        $total  = mysqli_num_rows($q1);
        $pages  = ceil($total / $per_halaman);
        $nomor  = $mulai + 1;
        $sql1   = $sql1." order by ID desc limit $mulai,$per_halaman";

        $q1     = mysqli_query($koneksi, $sql1);

        while ($r1 = mysqli_fetch_array($q1)) {
        ?>
            <tr>
                <td><?php echo $nomor++ ?></td>
                <td><?php echo $r1['Praktikan'] ?></td>
                <td><?php echo $r1['NRP'] ?></td>
                <td><?php echo $r1['Nilai'] ?></td>
                <td>
                    <a href="halaman_input.php?ID=<?php echo $r1['ID'] ?>">
                        <span class="badge bg-warning text-dark">Edit</span>
                    </a>
                    
                    <a href="halaman.php?op=DELETE&ID=<?php echo $r1['ID']?>" onclick="return confirm('Apakah anda yakin mau menghapus data ini?')">
                        <span class="badge bg-danger">Delete</span>
                    </a>
                </td>
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
                <a class="page-link" href="halaman.php?katakunci=<?php echo $katakunci?>&cari=<?php echo $cari?>&page=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>
<?php include("inc_footer.php") ?>