<?php
class room
{
    //localhost:81/apiCruciticos/room/consulta
    public function all()
    {
        try {
            $response = new Response();
            //Obtener el listado del Modelo
            $room = new RoomModel();
            $result = $room->all();
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
    //localhost:81/apiCruciticos/room/1
    public function get($param)
    {
        try {
            $response = new Response();
            $room = new RoomModel();
            $result = $room->get($param);
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }



    public function getRoomCruise($id)
    {
        try {
            $response = new Response();
            $room = new RoomModel();
            $result = $room->getRoomCruise($id);
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
    public function getCruisesbyRoom($param)
    {
        try {
            $response = new Response();
            $room = new RoomModel();
            $result = $room->getCruisesbyRoom($param);
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
        $user = new RoomModel();
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
            $room = new RoomModel();
            //Acción del modelo a ejecutar
            $result = $room->update($inputJSON);
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
            $userModel = new RoomModel();
    
            // Acción del modelo a ejecutar
            $result = $userModel->delete($id);
    
            // Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
