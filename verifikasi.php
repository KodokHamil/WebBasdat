<?php include("inc_header.php")?>
<style>
    .error{
        padding: 20px;
        background-color: #f44336;
        color: #FFFFFF;
        margin-bottom: 15px;
    }
    .sukses{
        padding: 20px;
        background-color: #4CAF50;
        color: #FFFFFF;
        margin-bottom: 15px;
    }
    h4 {
    font-family: 'open sans';
    font-weight: 800;
    font-size: 30px;
    margin-bottom: 20px;
    color: #364f6b;
    width: 100%;
    line-height: 50px;
    }
</style>

<?php 
$err     = "";
$sukses  = "";

if(!isset($_GET['email']) or !isset($_GET['kode'])){
    $err    = "Data yang diperlukan untuk verifikasi tidak tersedia.";
}else{
    $email  = $_GET['email'];
    $kode   = $_GET['kode'];

    $sql1   = "select * from admin where email = '$email'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    if($r1['status'] == $kode){
        $sql2   = "update admin set status = '1' where email = '$email'";
        mysqli_query($koneksi,$sql2);
        $sukses = "Akun telah aktif. Silakan login di halaman login.";
    }else{
        $err = "Kode tidak valid";
    }
}
?>
<h4>Halaman Verifikasi</h4>
<?php if($err) { echo "<div class='error'>$err</div>";}?>
<?php if($sukses) { echo "<div class='sukses'>$sukses</div>";}?>
<?php include("inc_footer.php")?>