    <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
function sendMail($email, $title, $message) {
    $mail = new PHPMailer(true);

    $mail->isSMTP(); 
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'congtunhahonguyen2001@gmail.com';
    $mail->Password = 'hgwa ocwt gdzb mipd';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('congtunhahonguyen2001@gmail.com');

    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = $title;
    $mail->Body = $message;
    
    $mail->send();

    return;
}

?>