<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "PHPMailer/src/Exception.php";
    require "PHPMailer/src/PHPMailer.php";


    $mail = new PHPMailer(true);
	
    $mail->CharSet = "UTF-8";
    $mail->IsHTML(true);
    
    $name = $_POST["name"];
    $email = $_POST["email"];
	$phone = $_POST["phone"];
    $message = $_POST["message"];
    $emailclient = $_POST["emailclient"];
    $checkbox = $_POST["checkbox"];
	$email_template = "template_mail.html";
    

    $body = file_get_contents($email_template);
	$body = str_replace('%name%', $name, $body);
	$body = str_replace('%email%', $email, $body);
	$body = str_replace('%phone%', $phone, $body);
	$body = str_replace('%message%', $message, $body);
    $body = str_replace('%emailclient%', $emailclient, $body);
    $body = str_replace('%checkbox%', $checkbox, $body);

    
    // $mail->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
    

    $mail->addAddress("metalbudukraine@gmail.com");   // Здесь введите Email, куда отправлять
	$mail->setFrom($email);
    $mail->Subject = "[Заявка с формы]";
    $mail->MsgHTML($body);

    if (!$mail->send()) {
        $message = "Помилка відправки";
    } else {
        $message = "Дані відправлено!";
    }
	

	$response = ["message" => $message];

    header('Content-type: application/json');
    echo json_encode($response);


?>