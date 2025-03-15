<?php
//class Inventory
class addon{

    //Listar en el API
    public function all(){
        $response = new Response();
        //Obtener el listado del Modelo
        $inventory=new AddonModel();
        $result=$inventory->all();
         //Dar respuesta
         $response->toJSON($result);
    }
    public function get($param)
    {
        $response = new Response();
        $user = new AddonModel();
        $result = $user->get($param);
        //Dar respuesta
        $response->toJSON($result);
    }

    public function create()
    {
        $response = new Response();
        $request = new Request();
        //Obtener json enviado
        $inputJSON = $request->getJSON();
        $addon = new AddonModel();
        $result = $addon->create($inputJSON);
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
            $addon = new AddonModel();
            //Acción del modelo a ejecutar
            $result = $addon->update($inputJSON);
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
            $addonModel = new AddonModel();
            // Acción del modelo a ejecutar
            $result = $addonModel->delete($id);
            // Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}