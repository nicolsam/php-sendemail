<?php

require __DIR__ . '/bootstrap/app.php';

use \App\Communication\Email;

$address = "breakly10@gmail.com";
$subject = "Olá mundo! e email :) com anexo!";
$body = "<div style='background: black; width: 100%; height: 150px; padding: 10px;'><h1 style='color: white; font-weight: 700;'>Olá mundo</h1></div>";
$attachment = __DIR__ . '/anexo-teste.txt';

$obEmail = new Email;
$sucesso = $obEmail->sendEmail($address, $subject, $body, $attachment);

echo $sucesso ? 'Mensagem enviada com sucesso' : $obEmail->getError();
