<?php
function url_dasar(){
    //$_SERVER['SERVER_NAME'] : alamat website, misalkan websitemu.com
    // $_SERVER['SCRIPT_NAME'] : directory website, websitemu.com/blog/ $_SERVER['SCRIPT_NAME'] : blog
    $url_dasar  = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);
    return $url_dasar;
}

function dapatkan_id(){
    $id     ="";
    if(isset($_SERVER['PATH_INFO'])){
        $id = dirname($_SERVER['PATH_INFO']);
        $id = preg_replace("/[^0-9]/","",$id);
    }
    return $id;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function kirim_email($email_penerima, $nama_penerima,$judul_email,$isi_email){
    
    $email_pengirim     = "andryanaufal@gmail.com";
    $nama_pengirim      = "noreply";

    //Load Composer's autoloader
    require getcwd().'/vendor/autoload.php';

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $email_pengirim;                     //SMTP username
        $mail->Password   = 'passwordmu';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom($email_pengirim, $nama_pengirim);
        $mail->addAddress($email_penerima,$nama_penerima);     //Add a recipient
       

        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $judul_email;
        $mail->Body    = $isi_email;
        

        $mail->send();
        return "sukses";
    } catch (Exception $e) {
        return "gagal: {$mail->ErrorInfo}";
    }
}