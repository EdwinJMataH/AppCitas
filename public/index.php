<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\ApiController;
use Controllers\AdminController;
use Controllers\ServiciosController;
use MVC\Router;


$router = new Router();

//Iniciar y cerrar sesión
$router->get('/',[LoginController::class, 'login']);
$router->post('/',[LoginController::class, 'login']);
$router->get('/logout',[LoginController::class, 'logout']);

//Recuperar password
$router->get('/olvide',[LoginController::class, 'olvide']);
$router->post('/olvide',[LoginController::class, 'olvide']);
$router->get('/recuperar',[LoginController::class, 'recuperar']);
$router->post('/recuperar',[LoginController::class, 'recuperar']);

//Crear cuenta
$router->get('/crear', [LoginController::class, 'crear']);
$router->post('/crear', [LoginController::class, 'crear']);

//Confirmación de cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);

$router->get('/mensaje', [LoginController::class, 'mensaje']);

//Vista para usuarios no admins
$router->get('/cita', [CitaController::class, 'index']);
//Vista para usuarios  admins
$router->get('/admin', [AdminController::class, 'index']);

//Extraer informacion de la BD
$router->get('/servicios', [ApiController::class, 'index']);
$router->post('/servicios/crear-cita', [ApiController::class, 'crear']);
$router->post('/servicios/eliminar-cita', [ApiController::class, 'eliminar']);

// CRUD de Servicios
$router->get('/admin/servicios', [ServiciosController::class, 'index']);
$router->get('/admin/servicios/crear', [ServiciosController::class, 'crear']);
$router->post('/admin/servicios/crear', [ServiciosController::class, 'crear']);
$router->get('/admin/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/admin/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/admin/servicios/eliminar', [ServiciosController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();