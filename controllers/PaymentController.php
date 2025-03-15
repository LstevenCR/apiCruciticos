<?php
//class Rental
class payment
{
    //Listar en el API
    public function all()
    {
        try {
            $response = new Response();
            //Obtener el listado del Modelo
            $rental = new PaymentModel();
            $result = $rental->all();
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
            //Instancia del modelo
            $rental = new PaymentModel();
            //Acción del modelo a ejecutar
            $result = $rental->get($param);
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }

    //POST Crear
    public function create()
    {
        try {
            $request = new Request();
            $response = new Response();
            //Obtener json enviado
            $inputJSON = $request->getJSON();
            //Instancia del modelo
            $payment = new PaymentModel($inputJSON);
            //Acción del modelo a ejecutar
            $result = $payment->create($inputJSON);
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
            $payment = new PaymentModel();
            //Acción del modelo a ejecutar
            $result = $payment->update($inputJSON);
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
            $paymentModel = new PaymentModel();
    
            // Acción del modelo a ejecutar
            $result = $paymentModel->delete($id);
    
            // Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
