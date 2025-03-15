<?php
//Cargar todos los paquetes
require_once "vendor/autoload.php";

use Firebase\JWT\JWT;

class reservation
{

    private $secret_key = 'e0d17975bc9bd57eee132eecb6da6f11048e8a88506cc3bffc7249078cf2a77a';
    //Listar en el API
    //localhost:81/apiCruciticos/reservation
    public function all()
    {
        $response = new Response();
        //Obtener el listado del Modelo
        $reservation = new ReservationModel();
        $result = $reservation->all();
        //Dar respuesta
        $response->toJSON($result);
    }
    public function get($param)
    {
        $response = new Response();
        $reservation = new ReservationModel();
        $result = $reservation->get($param);
        //Dar respuesta
        $response->toJSON($result);
    }

    public function create()
    {
        $response = new Response();
        $request = new Request();
        //Obtener json enviado
        $inputJSON = $request->getJSON();
        $user = new ReservationModel();
        $result = $user->create($inputJSON);
        //Dar respuesta
        $response->toJSON($result);
    }

    public function update()
    {
        try {
            $request = new Request();
            $response = new Response();
            //Obtener json enviado
            $inputJSON = $request->getJSON();
            //Instancia del modelo
            $reservation = new ReservationModel();
            //Acción del modelo a ejecutar
            $result = $reservation->update($inputJSON);
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }


    public function delete($id) {
        try {
            $response = new Response();
    
            // Asegurar que ID es numérico
            if (!is_numeric($id)) {
                throw new Exception('ID debe ser válido');
            }
    
            // Instancia del modelo
            $userModel = new ReservationModel();
    
            // Acción del modelo a ejecutar
            $result = $userModel->delete($id);
    
            // Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
