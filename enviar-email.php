<?php

require __DIR__ . '/bootstrap/app.php';

use \App\Communication\Email;

$address = "breakly10@gmail.com";
$subject = "Olá mundo! e email :)";
$body = "<div style='background: black; width: 100%; height: 150px;'><p style='color: white; font-weight: 700;'>Olá mundo</p></div>";

$obEmail = new Email;
$sucesso = $obEmail->sendEmail($address, $subject, $body);

echo $sucesso ? 'Mensagem enviada com sucesso' : $obEmail->getError();
