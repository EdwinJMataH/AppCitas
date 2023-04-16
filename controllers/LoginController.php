<?php
namespace Controllers;

use Classes\Email;
use Models\UsuariosModel;
use MVC\Router;

class LoginController {
    
    public static function login(Router $router) {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new UsuariosModel($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                $usuario = UsuariosModel::where('email_usuario', $auth->email_usuario);
                if ($usuario) {
                    if ($usuario->verificarPasswordAndConfirmado($auth->password_usuario)) {
                        session_start();
                        $_SESSION['login'] = true;
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['email'] = $usuario->email_usuario;
                        $_SESSION['nombre'] = $usuario->nombre_usuario . " " .$usuario->apellido_usuario;

                        if ($usuario->admin == '1') {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                    } 
                    
                } else {
                    UsuariosModel::setAlerta('error', 'Usuario no encontrado');
                }
            }

            $alertas = UsuariosModel::getAlertas();
        }

        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout(Router $router) {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function olvide(Router $router) {

        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new UsuariosModel($_POST);
            $alertas = $auth->validarEmail();
            if (empty($alertas)) {
                $usuario = UsuariosModel::where('email_usuario', $auth->email_usuario);
                if ($usuario && $usuario->confirmado == "1") {
                    $usuario->generarToken();
                    $usuario->guardar();

                    $mail = new Email(
                        $usuario->nombre_usuario,
                        $usuario->email_usuario,
                        $usuario->token
                    );

                    $mail->enviarInstrucciones();
                    UsuariosModel::setAlerta('exito', 'Instrucciones enviadas a su correo');
                } else {
                    UsuariosModel::setAlerta('error', 'Correo inexistente o no confirmado');
                }
            }
        }
        $alertas = UsuariosModel::getAlertas();

        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router) {

        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        $usuario = UsuariosModel::where('token', $token);

        if (empty($usuario)) {
            UsuariosModel::setAlerta('error', 'Token no valído');
            $error = true;
        } 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = new UsuariosModel($_POST);
            $alertas = $password->validarNuevaPassword();
            if (empty($alertas)) {
                $usuario->token = '';
                $usuario->password_usuario = $password->password_usuario;
                $usuario->passwordHasheado();
                $resultado = $usuario->guardar();

                if ($resultado) {
                    header('Location: /');
                }
            }
        }
        $alertas = UsuariosModel::getAlertas();

        $router->render('auth/recuperar', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function crear(Router $router) {
        $usuario = new UsuariosModel;
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevosUsuarios();

            //Revisa que no hayas alertas
            if (empty($alertas)) {
                $respuesta = $usuario->validarExistencia();

                if ($respuesta->num_rows) {
                    $alertas = $usuario::getAlertas();
                } else {
                    $usuario->passwordHasheado();
                    $usuario->generarToken();

                    $mail = new Email(
                        $usuario->nombre_usuario,
                        $usuario->email_usuario,
                        $usuario->token
                    );

                    $mail->enviarConfirmacion();
                    $respuesta = $usuario->guardar();

                    if ($respuesta) {
                        header('Location: /mensaje');
                    }
                }
            } 
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function confirmar(Router $router) {
        $alertas = [];
        $token = s($_GET['token']);
        $respuesta = UsuariosModel::where('token', $token);

        if (empty($respuesta)) {
            UsuariosModel::setAlerta('error', 'Token no valído');
        } else {
            UsuariosModel::setAlerta('exito', 'Token valído');
            $respuesta->confirmado = 1;
            $respuesta->token = '';
            $respuesta->guardar();
        }

        $alertas = UsuariosModel::getAlertas();

        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje');
    }
}