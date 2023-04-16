<?php
namespace Models;
class CitasModel extends ActiveRecord {

    protected static $tabla = 'citas';
    protected static $columnasDB = [
        'id', 
        'fecha_cita',	
        'hora_cita',	
        'id_usuarioFK'
    ];
    public $id;
    public $fecha_cita; 
    public $hora_cita;		
    public $id_usuarioFK;	

    public function __construct ($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fecha_cita = $args['fecha_cita'] ?? '';
        $this->hora_cita = $args['hora_cita'] ?? '';
        $this->id_usuarioFK = $args['id_usuarioFK'] ?? '';
    }
}



