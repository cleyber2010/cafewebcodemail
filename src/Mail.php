<?php

namespace Cafewebcode\Cafewebcodemail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

/**
 *  CLASS MAIL
 */
class Mail
{

    /** @var PHPMailer */
    protected PHPMailer $mail;

    protected ?object $data;

    private ?MailException $fail;

    protected string $message;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        //config
        $this->mail->isSMTP();
        $this->mail->isHTML(CONF_MAIL_HTML);
        $this->mail->CharSet = CONF_MAIL_CHARSET;
        $this->mail->setLanguage(CONF_MAIL_LANG);
        $this->mail->Host = CONF_MAIL_HOST;
        $this->mail->SMTPAuth = CONF_MAIL_SMTPAUTH;
        $this->mail->Username = CONF_MAIL_USERNAME;
        $this->mail->Password = CONF_MAIL_PASSWORD;
        $this->mail->SMTPSecure = CONF_MAIL_SMTPSECURE;
        $this->mail->Port = CONF_MAIL_PORT;
    }

    public function bootstrap(string $subject, string $body, string $recipient, string $recipientName): Mail
    {
        $this->data = new \stdClass();
        $this->data->subject = $subject;
        $this->data->body = $body;
        $this->data->recipient = $recipient;
        $this->data->recipientName = $recipientName;

        return $this;
    }

    public function fail(): ?MailException
    {
        return $this->fail;
    }

    public function attach(string $patch, string $name): ?Mail
    {
        $this->data->attach[$patch] = $name;
        return $this;
    }

    public function send(string $from, string $fromName): bool
    {
        try {
            if (!$this->required()) {
                $this->message = "Preencha todos os dados para enviar";
                return false;
            }
            if (!filter_var($this->data->recipient, FILTER_VALIDATE_EMAIL)) {
                $this->message = "O e-mail de destinatário não parece válido";
                return false;
            }

            if (!empty($this->data->attach)) {
                foreach ($this->data->attach as $path => $name) {
                    $this->mail->addAttachment($path, $name);
                }
            }
            $this->mail->setFrom($from, $fromName);
            $this->mail->addAddress($this->data->recipient, $this->data->recipientName);
            $this->mail->Subject = filter_var($this->data->subject, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->mail->Body = filter_var($this->data->body, FILTER_DEFAULT);

            $this->mail->send();
            return true;

        } catch (MailException $exception) {
            $this->fail = $exception;
            return false;
        }
    }

    private function required(): bool
    {
        if (empty($this->data->subject) || empty($this->data->body) || empty($this->data->recipient) || empty($this->data->recipientName)) {
            return false;
        }

        return true;
    }
}