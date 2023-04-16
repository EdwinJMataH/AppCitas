<?php
namespace Models;

class ServiciosModel extends ActiveRecord {
    protected static $tabla = 'servicios';
    protected static $columnasDB = [
        'id', 
        'nombre_servicio',	
        'precio_servicio'
    ];
    public $id;
    public $nombre_servicio; 
    public $precio_servicio;
    
    public function __construct($args = []) {
        $this->id = $args['id_servicio'] ?? null;
        $this->nombre_servicio = $args['nombre_servicio'] ?? '';
        $this->precio_servicio = $args['precio_servicio'] ?? 0;
    }

    public function validar() {
        if (!$this->nombre_servicio) {
            self::$alertas['error'][] = 'Nombre obligatorio';
        }

        if (!$this->precio_servicio) {
            self::$alertas['error'][] = 'Precio obligatorio';
        }
    
        if (!is_numeric($this->precio_servicio)) {
            self::$alertas['error'][] = 'Precio invalido';
        }

        return self::$alertas;
    }
}