<?php
class cruise
{
    //localhost:81/apiCruciticos/cruise/all
    public function all()
    {
        try {
            $response = new Response();
            //Obtener el listado del Modelo
            $cruise = new CruiseModel();
            $result = $cruise->all();
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
            $cruise = new CruiseModel();
            $result = $cruise->get($param);
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
        $cruise = new CruiseModel();
        $result = $cruise->create($inputJSON);
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
            $cruise = new CruiseModel();
            //Acción del modelo a ejecutar
            $result = $cruise->update($inputJSON);
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
            $cruiseModel = new CruiseModel();
    
            // Acción del modelo a ejecutar
            $result = $cruiseModel->delete($id);
    
            // Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }

    public function getCountByPort($param)
    {
        try {
            $response = new Response();
            //Instancia del modelo
            $cruise = new CruiseModel();
            //Acción del modelo a ejecutar
            $result = $cruise->getCountByPort($param);
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
