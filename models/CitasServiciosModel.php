<?php
namespace Models;
class CitasServiciosModel extends ActiveRecord {
    protected static $tabla = 'citas_servicios';
    protected static $columnasDB = [
        'id', 
        'id_citaFK',	
        'id_servicioFK'
    ];
    public $id;
    public $id_citaFK; 
    public $id_servicioFK;	
    
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->id_citaFK = $args['id_citaFK'] ?? '';
        $this->id_servicioFK = $args['id_servicioFK'] ?? '';
    }
}