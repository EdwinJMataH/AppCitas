<?php
namespace Controllers;

use Models\AdminModel;
use MVC\Router;

class AdminController {

    public static function index(Router $router) {
        date_default_timezone_set('America/Mexico_City');
        isAdmin();

        if (!isset($_SESSION)) {
            session_start();
        }

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);

        if( !checkdate( $fechas[1], $fechas[2], $fechas[0]) ) {
            header('Location: /404');
        }

        $query = "SELECT citas.id, citas.hora_cita, CONCAT(usuarios.nombre_usuario, ' ', usuarios.apellido_usuario) as cliente, usuarios.email_usuario, servicios.nombre_servicio as servicio, servicios.precio_servicio as precio";
        $query .= " FROM citas ";
        $query .= " INNER JOIN usuarios ON citas.id_usuarioFK = usuarios.id ";
        $query .= " INNER JOIN citas_servicios ON citas_servicios.id_citaFK = citas.id ";
        $query .= " INNER JOIN servicios ON servicios.id = citas_servicios.id_servicioFK";
        $query .= " WHERE fecha_cita = '${fecha}'";


        $citas = AdminModel::SQLAll($query);
        // debuguear($respuesta);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'], 
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}