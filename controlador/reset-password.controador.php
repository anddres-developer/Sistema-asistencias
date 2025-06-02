<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vistas/PHPMailer/src/Exception.php';
require 'vistas/PHPMailer/src/PHPMailer.php';
require 'vistas/PHPMailer/src/SMTP.php';
//include '../config.php';

class ctrResetPassword
{

    static public function ctrResetPassword()
    {
        $host_email = $_ENV['SMTP_HOST'];
        $port_email = $_ENV['SMTP_PORT'];
        $correo_email = $_ENV['SMTP_EMAIL'];
        $token_email = $_ENV['SMTP_TOKEN'];


        if (isset($_POST['reset-password'])) {
            $tabla = "usuarios";
            $item = "usuario";
            $valor = $_POST['reset-password'];

            $respuesta = mdlUsuarios::mdlSesionUsuarios($tabla, $item, $valor);


            if ($respuesta['usuario'] == $_POST['reset-password']) {

                $passwordNuevo = uniqid();
                $password = crypt($passwordNuevo, '$5$rounds=5000$usesomesillystringforsalt$');

                $datos = array(
                    "idE" => $respuesta['id'],
                    "passE" => $password,
                );

                if ($respuesta['email'] != null) {

                    $mail = new PHPMailer; // Crear una instancia de PHPMailer

                    //$mail->SMTPDebug = 1; // Habilitar debug (solo en desarrollo)
                    $mail->isSMTP(); // Establecer como envío SMTP
                    $mail->Host = $host_email; // Servidor SMTP
                    $mail->Port = $port_email; // Puerto SMTP
                    $mail->SMTPSecure = 'tls'; // Tipo de seguridad (tls o ssl)
                    $mail->SMTPAuth = true; // Habilitar autenticación SMTP
                    $mail->Username = $correo_email; // Nombre de usuario SMTP
                    $mail->Password = $token_email; // Contraseña SMTP e2fb1 e929d 075a2 c6d62

                    $mail->setFrom($correo_email, 'Sistema de asistencias'); // Remitente
                    $mail->addAddress($respuesta['email'], $respuesta['usuario']); // Destinatario

                    $mail->isHTML(true);
                    $mail->Subject = 'Nueva Clave de Acceso Sistema de Asistencias'; // Asunto
                    $mail->Body =  'Se ha creado una nueva calve de acceso para el susario ' . $_POST['reset-password'] . '  es: <b>' . $passwordNuevo . '</b>'; // Cuerpo del mensaje
                    $mail->AltBody = 'Cuerpo de texto plano para correos que no soportan HTML'; // Versión de texto plano

                    /*if ($mail->send()) {
                        echo '<br>La contraseña <b>' . $passwordNuevo . '</b> Se ha sido enviado a ' . $respuesta['email'];
                    }*/

                    $tabla = "usuarios";
                    $respuesta2 = mdlUsuarios::mdlEditarPassword($tabla, $datos);


                    if ($respuesta2 == 'ok') {
                        echo '<script> Swal.fire({
							icon: "success",
							title: "Se envío un correo electronico con la contrasea nueva",
							showConfirmButton: false,
							timer: 10000
						}); </script>';
                    }
                } else {
                    echo '<script> Swal.fire({
						icon: "error",
						title: "El usuario no tiene correo electronico pongase en contacto con el administrador",
						showConfirmButton: false,
						timer: 2000
					}); </script>';
                }
            } else {
                echo '<script> Swal.fire({
						icon: "error",
						title: "El usuario no existe",
						showConfirmButton: false,
						timer: 2000
					}); </script>';
            }
        }
    }
}
