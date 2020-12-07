<?php

require_once '../../vendor/autoload.php';



//Create the Transport
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
        ->setUsername('e730313f24c366')
        ->setPassword('25d5b38684f393')
    ;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create Message
$message = (new Swift_Message($_POST['subjectMail']))
    ->setFrom($_POST['email'])
    ->setTo(['killian.minetto@gmail.com' => 'Kilian MINETTO'])
    ->setBody(htmlspecialchars($_POST['textMail']));

$result = $mailer->send($message);

}
else {
    $email = htmlspecialchars($_POST['email']);
    $to      = 'killian.minetto@gmail.com';
    $subject = htmlspecialchars($_POST['subjectMail']);
    $message = htmlspecialchars($_POST['textMail']);
    $headers = "From: {$email}" . "\r\n" .
        "Reply-To: {$email}" . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}