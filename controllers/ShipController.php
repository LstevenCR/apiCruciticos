<?php
class ship
{
    public function all()
    {
        try {
            $response = new Response();
            //Obtener el listado del Modelo
            $genero = new ShipModel();
            $result = $genero->all();
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
    public function get($param)
    {
        try {
            $response = new Response();
            $genero = new ShipModel();
            $result = $genero->get($param);
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }

    public function update()
    {
        try {
            $request = new Request();
            $response = new Response();
            //Obtener json enviado
            $inputJSON = $request->getJSON();
            //Instancia del modelo
            $ship = new ShipModel();
            //Acción del modelo a ejecutar
            $result = $ship->update($inputJSON);
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
            $userModel = new ShipModel();
    
            // Acción del modelo a ejecutar
            $result = $userModel->delete($id);
    
            // Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
