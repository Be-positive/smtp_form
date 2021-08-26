<?php
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST['name']) && isset($_POST['email'])){
    $name = $_POST['name'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $services = $_POST['services'];
    $body = $_POST['body'];
    $ip = $_POST['ip'];

    require_once 'includes/PHPMailer.php';
    require_once 'includes/SMTP.php';
    require_once 'includes/Exception.php';

    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = "true";
    $mail->Username = "felps0308@gmail.com";
    $mail->Password = "volod1999";
    $mail->Port = "587"; //or 465
    $mail->SMTPSecure = "tls";
    $mail->Subject = "Test Email Using PHPMailer";

    //connect with HTML
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress("felps0308@gmail.com");
    $mail->Subject = ("$email ($name)");
    $mail->Body = ("Город: $city" . "<br>" . "Услуга: $services" . "<br>" . "Номер телефона: $telephone" . "<br>" . "IP Address: $ip" . "<br>" . "Комментарий: $body" );

    if($mail->send()){
        $status = "success!";
        $response = "Информация отправлена!";
    } else {
        $status = "failed";
        $response = "Что то пошло не так..." . $mail->ErrorInfo;
    }
    exit(json_encode(array("status" => $status, "response" => $response)));
}
?>





