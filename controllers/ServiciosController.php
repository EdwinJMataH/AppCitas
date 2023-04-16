<?php
namespace Controllers;

use Models\ServiciosModel;
use MVC\Router;
class ServiciosController {
    public static function index(Router $router) {
        if (!isset($_SESSION)) {
            session_start();
        }
        isAdmin();
        $servicios = ServiciosModel::all();
        // debuguear($servicios);

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crear(Router $router) {
        if (!isset($_SESSION)) {
            session_start();
        }
        isAdmin();
        $servicio = new ServiciosModel;
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if (empty($alertas)) {
                $servicio->guardar();
                header('Location: /admin/servicios');
            }
        }

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'], 
            'alertas' => $alertas,
            'servicio' => $servicio
        ]);
    }

    public static function actualizar(Router $router) {
        if (!isset($_SESSION)) {
            session_start();
        }
        isAdmin();

        if (!is_numeric($_GET['id'])) return;

        $alertas = [];
        $servicio = ServiciosModel::find($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if(empty($alertas)) {
                $servicio->guardar();
                header('Location: /admin/servicios');
            }
        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'], 
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar(Router $router) {
        if (!isset($_SESSION)) {
            session_start();
        }
        isAdmin();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $servicio = ServiciosModel::find($id);
            $servicio->eliminar();
            header('Location: /admin/servicios');
        }
    }
}