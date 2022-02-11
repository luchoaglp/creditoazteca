<?php

if(isset($_POST['phone']) && !empty($_POST['phone']) &&
   isset($_POST['email']) && !empty($_POST['email'])) {

  require_once('phpmailer/class.phpmailer.php');
  require_once('phpmailer/class.smtp.php');

  $mail = new PHPMailer();

  // $mail->SMTPDebug = 3;                // Enable verbose debug output
  $mail->isSMTP();                        // Set mailer to use SMTP
  $mail->Host = 'mail.creditoazteca.com'; // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                 // Enable SMTP authentication
  $mail->Username = 'no-reply@creditoazteca.com'; // SMTP username
  $mail->Password = 'S@ul1Nx1';           // SMTP password
  $mail->SMTPSecure = true;               // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                      // TCP port to connect to

  $message = "";

  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);

  $subject = 'Nuevo mensaje | Prestamo Online';

  $toemail = 'webmaster@creditoazteca.com'; // Your Email Address
  $toname = 'Crédito Azteca';               // Your Name

  $mail->SetFrom($mail->Username, $email);
  $mail->AddAddress($toemail , $toname);
  $mail->Subject = $subject;

  $email = "Email: $email<br>";
  $phone = "Telefono: $phone<br><br>";

  $referrer = $_SERVER['HTTP_REFERER'] ? 'Mensaje enviado desde: ' . $_SERVER['HTTP_REFERER'] : '';

  $body = "$email $phone $referrer";

  $mail->MsgHTML($body);
            
  $sendEmail = $mail->Send();

  echo json_encode($sendEmail);
}