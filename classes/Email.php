<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email {
    public $nombre;
    public $mail;
    public $token;


    public function __construct($nombre, $mail, $token) {
        $this->nombre = $nombre;
        $this->mail = $mail;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

        $phpmailer = new PHPMailer(true);
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '069e04cd3e3f73';
        $phpmailer->Password = '4e1978bf398523';

        $phpmailer->setFrom('edwin@appcitas.com');
        $phpmailer->addAddress('mata@appcitas.com', 'AppCitas');
        $phpmailer->Subject = 'Confirmacion de la cuenta';

        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>".$this->nombre."</strong></p>";
        $contenido .= "<p>Has creado una cuenta en AppCita, debes confirmar la cuenta en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://appcitas.test/confirmar-cuenta?token=".$this->token."'>Confirmar cuenta</a></p>";
        $contenido .= "</html>";

        $phpmailer->Body = $contenido;
        $phpmailer->send();

    }

    public function enviarInstrucciones() {

        $phpmailer = new PHPMailer(true);
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '069e04cd3e3f73';
        $phpmailer->Password = '4e1978bf398523';

        $phpmailer->setFrom('edwin@appcitas.com');
        $phpmailer->addAddress('mata@appcitas.com', 'AppCitas');
        $phpmailer->Subject = 'Recuperación de la cuenta';

        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>".$this->nombre."</strong></p>";
        $contenido .= "<p>Has pedido restablecer la contraseña de una cuenta en AppCita, debes cambiar la constraseña en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://appcitas.test/recuperar?token=".$this->token."'>Establecer nueva contraseña</a></p>";
        $contenido .= "</html>";

        $phpmailer->Body = $contenido;
        $phpmailer->send();

    }
}