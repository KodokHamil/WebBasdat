<?php include("inc_header.php")?>
<?php 
if($_SESSION['admin_email'] == ''){ //dia belum login
    header("location:login.php");
    exit();
}
?>
<div style="background-color: green;font-size:large;padding:50px;color:#FFFFFF;text-align:center">
Selamat datang admin <?php echo $_SESSION['admin_nama_lengkap']?>. 
</div>
<?php include("inc_footer.php")?>