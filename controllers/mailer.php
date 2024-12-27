<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require('../vendor/autoload.php');
    
    $mail = new PHPMailer(true);
    
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = "generalconsultinggroupltd@gmail.com";
    $mail->Password = "yxpy lniu ruuc bhef";
    
    $mail->isHtml(true);
    
    return $mail;
   
?>


