<?php
//class Genre
class port{
    //Listar en el API
    public function all(){
        $response = new Response();
        //Obtener el listado del Modelo
        $port=new PortModel();
        $result=$port->all();
         //Dar respuesta
         $response->toJSON($result);
    }
    public function get($param){
        $response = new Response();
        $port=new PortModel();
        $result=$port->get($param);
        //Dar respuesta
        $response->toJSON($result);
    }
   

    public function getPortCruise($id)
    {
        try {
            $response = new Response();
            $genero = new PortModel();
            $result = $genero->getPortCruise($id);
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
    public function getCruisesbyPort($param)
    {
        try {
            $response = new Response();
            $genero = new PortModel();
            $result = $genero->getCruisesbyPort($param);
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }






    public function create()
    {
        $response = new Response();
        $request = new Request();
        //Obtener json enviado
        $inputJSON = $request->getJSON();
        $user = new PortModel();
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
            $port = new PortModel();
            //Acción del modelo a ejecutar
            $result = $port->update($inputJSON);
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
            $portModel = new PortModel();
    
            // Acción del modelo a ejecutar
            $result = $portModel->delete($id);
    
            // Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}