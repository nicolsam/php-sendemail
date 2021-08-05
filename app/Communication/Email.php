<?php

namespace App\Communication;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Email {
    
    /**
     * Mensagem de erro do envio
     *
     * @var [type]
     */
    private $error;

    /**
     * Método responsável por retornar mensagem de erro do envio
     */
    public function getError() {
        return $this->error;
    }

    /**
     * Método responsável por enviar um email
     *
     * @param   string|array  $addresses    [$addresses description]
     * @param   string  $subject      [$subject description]
     * @param   string  $body         [$body description]
     * @param   string|array  $attachments  [$attachments description]
     * @param   string|array  $ccs          [$ccs description]
     * @param   string|array  $bccs         [$bccs description]
     * @return boolean
     */
    public function sendEMail($addresses, $subject, $body, $attachments = [], $ccs = [], $bccs = []) {
        // Limpar a mensagem de erro
        $this->error = '';

        // Instância de PHPMailer
        $obMail = new PHPMailer(true);

        try {

            $obMail->isSMTP(true);
            $obMail->Host = getenv('SMTP_HOST');
            $obMail->SMTPAuth = true;
            $obMail->Username = getenv('SMTP_USER');
            $obMail->Password = getenv('SMTP_PASSWORD');
            $obMail->SMTPSecure = getenv('SMTP_SECURE');
            $obMail->Port = getenv('SMTP_PORT');
            $obMail->CharSet = getenv('SMTP_CHARSET');

            // Remetente
            $obMail->setFrom(getenv('SMTP_FROM_EMAIL'), getenv('SMTP_FROM_NAME'));

            // Destinatários
            $addresses = is_array($addresses) ? $addresses : [$addresses];
            foreach($addresses as $address) {
                $obMail->addAddress($address);
            }

            // Anexos
            $attachments = is_array($attachments) ? $attachments : [$attachments];
            foreach($attachments as $attachment) {
                $obMail->addAttachment($attachment);
            }

            // CCs
            $ccs = is_array($ccs) ? $ccs : [$ccs];
            foreach($ccs as $cc) {
                $obMail->addCC($cc);
            }

            // BCCs
            $bccs = is_array($bccs) ? $bccs : [$bccs];
            foreach($bccs as $bcc) {
                $obMail->addBCC($bcc);
            }

            // Conteúdo do EMAIL
            $obMail->isHTML(true);
            $obMail->Subject = $subject;
            $obMail->Body = $body;

            // Envia o Email
            return $obMail->send();

        } catch(PHPMailerException $error) {
            $this->error = $error->getMessage();
            return false;
        }
    }

}