<?php include("inc_header.php")?>
<style>
    table {
        width: 600px;
    }

    @media screen and (max-width: 700px) {
        table {
            width: 90%;
        }
    }
    table td {
        padding: 5px;
    }
    td.label { width: 40%;}
    .input {
        border: 1px solid #CCCCCC;
        background-color: #dfdfdf;
        border-radius: 5px;
        padding: 10px;
        width: 100%;
    }
    input.tbl-biru{
        border: none;
        background-color: #3f72af;
        border-radius: 20px;
        margin-top: 20px;
        padding: 15px 20px 15px 20px;
        color: #FFFFFF;
        cursor: pointer;
        font-weight: bold;
    }
    input.tbl-biru:hover{
        background-color: #f39c12;
        text-decoration: none;
    }
    h4 {
    font-weight: bold;
    font-size: 30px;
    margin-bottom: 20px;
    color: #364f6b;
    width: 100%;
    line-height: 50px;
    }
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

    .error ul{ margin-left: 10px;}
</style>

<h4>Login Ke Halaman Admin</h4>
<?php 
$email      = "";
$password   = "";
$err        = "";

if(isset($_POST['login'])){
    $email      = $_POST['email'];
    $password   = $_POST['password'];

    if($email == '' or $password == ''){
        $err .= "<li>Silakan masukkan semua isian</li>";
    }else{
        $sql1   = "select * from admin where email = '$email'";
        $q1     = mysqli_query($koneksi,$sql1);
        $r1     = mysqli_fetch_array($q1);
        $n1     = mysqli_num_rows($q1);

        if($n1 > 0){
            if($r1['status'] != '1'){
                $err .= "<li>Akun yang kamu miliki belum aktif</li>";
            }
            elseif($r1['password'] != md5($password)){
                $err .= "<li>Password tidak sesuai</li>";
            }
            else{
                $_SESSION['admin_email'] = $email;
                $_SESSION['admin_nama_lengkap'] = $r1['nama_lengkap'];
                
                header("location:rahasia.php");
                exit();
            }
        } else {
            $err .= "<li>Akun tidak ditemukan</li>";
        }
    }
}
?>
<?php if($err){ echo "<div class='error'><ul class='pesan'>$err</ul></div>";}?>
<form action="" method="POST">
    <table>
        <tr>
            <td class="label">Email</td>
            <td><input type="text" name="email" class="input" value="<?php echo $email?>"/></td>
        </tr>
        <tr>
            <td class="label">Password</td>
            <td><input type="password" name="password" class="input" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="login" value="Login" class="tbl-biru"/></td>
        </tr>
    </table>
</form>
<?php include("inc_footer.php")?>