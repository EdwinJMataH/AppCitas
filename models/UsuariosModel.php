<?php
namespace Models;
class UsuariosModel extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = [
        'id', 
        'nombre_usuario',	
        'apellido_usuario',	
        'email_usuario',	
        'password_usuario',	
        'admin',	
        'confirmado',	
        'token'
    ];
    public $id;
    public $nombre_usuario; 
    public $apellido_usuario;	
    public $email_usuario;	
    public $password_usuario;	
    public $admin;	
    public $confirmado;	
    public $token;	

    public function __construct($args = []) {
        $this->id = $args['id_usuario'] ?? null;
        $this->nombre_usuario = $args['nombre_usuario'] ?? '';
        $this->apellido_usuario = $args['apellido_usuario'] ?? '';
        $this->email_usuario = $args['email_usuario'] ?? '';
        $this->password_usuario = $args['password_usuario'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    public function validarNuevosUsuarios() {
        if (!$this->nombre_usuario) {
            self::$alertas['error'][] = "Nombre obligatorio";
        }
        if (!$this->apellido_usuario) {
            self::$alertas['error'][] = 'Apellido obligatorio';
        }
        if (!$this->email_usuario) {
            self::$alertas['error'][] = 'Correo obligatorio';
        }
        if (!$this->password_usuario) {
            self::$alertas['error'][] = 'Contraseña obligatorio';
        }

        if (strlen($this->password_usuario) < 8) {
            self::$alertas['error'][] = 'Contraseña debe tener más de 8 caracteres';
        }

        return self::$alertas;
    }

    public function validarExistencia() {
        $sql = "SELECT * FROM ". self::$tabla . " WHERE email_usuario = '" . $this->email_usuario . "' LIMIT 1";

        $resultado = self::$db->query($sql);

        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El correo se encuentra registrado';
        }

        return $resultado;
    }

    public function passwordHasheado() {
        $this->password_usuario = password_hash($this->password_usuario, PASSWORD_BCRYPT);
    }

    public function generarToken() {
        $this->token = uniqid();
    }

    public function validarLogin() {
        if (!$this->email_usuario) {
            self::$alertas['error'][] = 'Correo obligatorio';
        }
        if (!$this->password_usuario) {
            self::$alertas['error'][] = 'Contraseña obligatorio';
        }
        return self::$alertas;
    }

    public function validarEmail() {
        if (!$this->email_usuario) {
            self::$alertas['error'][] = 'Correo obligatorio';
        }
        return self::$alertas;
    }

    public function validarNuevaPassword() {
        if (!$this->password_usuario) {
            self::$alertas['error'][] = 'Contraseña obligatorio';
        }

        if (strlen($this->password_usuario) < 8) {
            self::$alertas['error'][] = 'Contraseña debe tener más de 8 caracteres';
        }
        return self::$alertas;
    }

    public function verificarPasswordAndConfirmado($password) {
        $comparacion = password_verify($password, $this->password_usuario);
        if (!$comparacion || $this->confirmado != "1") {
            self::$alertas['error'][] = 'Correo o contraseña incorrectos';
        } else {
            return true;
        }
    }
    
}