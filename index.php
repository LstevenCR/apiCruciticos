<?php
// Composer autoloader
require_once 'vendor/autoload.php';
/*Encabezada de las solicitudes*/
/*CORS*/
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json');

/*--- Requerimientos Clases o librerías*/
require_once "controllers/core/Config.php";
require_once "controllers/core/HandleException.php";
require_once "controllers/core/Logger.php";
require_once "controllers/core/MySqlConnect.php";
require_once "controllers/core/Request.php";
require_once "controllers/core/Response.php";
require_once "middleware/AuthMiddleware.php";

/***--- Agregar todos los modelos*/
require_once "models/UserModel.php";
require_once "models/RoomModel.php";
require_once "models/CruiseModel.php";
require_once "models/ShipModel.php";
require_once "models/DestinationModel.php";
require_once "models/PortModel.php";
require_once "models/AddonModel.php";
require_once "models/PaymentModel.php";
require_once "models/ImageModel.php";
require_once "models/ReservationModel.php";

/***--- Agregar todos los controladores*/
require_once "controllers/UserController.php";
require_once "controllers/RoomController.php";
require_once "controllers/CruiseController.php";
require_once "controllers/ShipController.php";
require_once "controllers/DestinationController.php";
require_once "controllers/PortController.php";
require_once "controllers/AddonController.php";
require_once "controllers/PaymentController.php";
require_once "controllers/ImageController.php";
require_once "controllers/ReservationController.php";

//Enrutador
require_once "routes/RoutesController.php";
$index = new RoutesController();
$index->index();