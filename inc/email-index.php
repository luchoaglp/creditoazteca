<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

if(isset($_POST['name']) && !empty($_POST['name']) &&
   isset($_POST['email']) && !empty($_POST['email']) &&
   isset($_POST['phone']) && !empty($_POST['phone']) &&
   isset($_POST['message'])) {

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

  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $message = trim($_POST['message']);

  $subject = 'Nuevo mensaje | Contacto Web';

  $toemail = 'webmaster@creditoazteca.com'; // Your Email Address
  $toname = 'Crédito Azteca';               // Your Name

  $mail->SetFrom($mail->Username, $email);
  $mail->AddAddress($toemail , $toname);
  $mail->Subject = $subject;

  $name = "Nombre: $name<br>";
  $email = "Email: $email<br>";
  $phone = "Telefono: $phone<br>";
  $message = "Mensaje: $message<br><br>";

  $referrer = $_SERVER['HTTP_REFERER'] ? 'Mensaje enviado desde: ' . $_SERVER['HTTP_REFERER'] : '';

  $body = "$name $email $phone $message $referrer";

  $mail->MsgHTML($body);
            
  $sendEmail = $mail->Send();

  echo json_encode($sendEmail);
}