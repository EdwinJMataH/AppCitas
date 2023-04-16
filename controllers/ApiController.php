<?php
namespace Controllers;

// use Models\ActiveRecord;
use Models\CitasModel;
use Models\CitasServiciosModel;
use Models\ServiciosModel;

class ApiController {
    
    public static function index() {

        $servicio = ServiciosModel::all();
        echo json_encode($servicio, JSON_UNESCAPED_UNICODE);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cita = CitasModel::find($_POST['id']);
            $cita->eliminar();
            //HTTP_REFERER ES PARA SABER LA URL DE DONDE SE VIENE
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }

    public static function crear() {
        $cita = new CitasModel($_POST);
        $respuesta = $cita->guardar();
        $id = $respuesta['id'];
        $servicios = explode(',', $_POST['servicios']);

        foreach($servicios as $servicio) {
            $args = [
                'id_citaFK' => $id,
                'id_servicioFK' => $servicio
            ];
            $citaServicio = new CitasServiciosModel($args);
            $citaServicio->guardar();
        }
        echo json_encode($respuesta);
    }
}