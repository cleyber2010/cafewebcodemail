<?php

require __DIR__ . "/../src/config.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/PHPMailer.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/Exception.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/SMTP.php";
require __DIR__ . "/../src/Mail.php";

use Cafewebcode\Cafewebcodemail\Mail;

$mail = new Mail();

$mail->bootstrap(
    "Teste de envio " . time(),
    "<h1>Olá mundo</h1><p>Esse é um teste de envio de e-mail</p>",
    "email@email.com.br",
    "Nome Destinatário"
);

if ($mail->send("contato@agenciacafeweb.com.br", "Agencia Café Web")) {
    echo "Enviado com sucesso";
} else {
    var_dump($mail->fail());
}

/** Enviando anexos */

$mail->attach("caminho-do-arquivo", "nome-do-arquivo");