<?php
namespace Models;
class AdminModel extends ActiveRecord {
    protected static $tabla = 'citas_servicios';
    protected static $columnasDB = [
        'id', 
        'cliente', 
        'hora_cita',	
        'email_usuario',	
        'servicio',
        'precio'
    ];
    public $id;
    public $cliente;
    public $hora_cita; 
    public $email_usuario;		
    public $servicio;	
    public $precio;	

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->cliente = $args['cliente'] ?? '';
        $this->hora_cita = $args['hora_cita'] ?? '';
        $this->email_usuario = $args['email_usuario'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }
}