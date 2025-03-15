<?php
class CruiseModel
{
    public $enlace;
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
    /*Listar */
    //Ver todos los cruceros
    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM cruise where state = TRUE";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ($vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }
    /*Obtener */
    //Ver todos los cruceros por ID
    public function get($id)
    {
        try {
            //Construyo instancia de destino
            $portM=new PortModel();
            $shipM=new shipModel();
            $destinationM=new destinationModel();
            $roomM=new RoomModel();
            //Consulta sql
			$vSql = "SELECT * FROM cruise where id=$id && state = TRUE";
			

            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            if(!empty($vResultado)){
                $vResultado=$vResultado[0];

                //Puerto
                $port=$portM->getPortCruise($vResultado->id);
                $vResultado->port=$port;
                //barcos
                $ship=$shipM->get($vResultado->shipId);
                $vResultado->ship=$ship; 
                //destino
                $destination=$destinationM->get($vResultado->destinationId);
                $vResultado->destination=$destination; 
                //Habitación
                $room=$roomM->getRoomCruise($vResultado->id);
                $vResultado->room=$room; 
                // Retornar el objeto
                return $vResultado;
            }
		} catch (Exception $e) {
            handleException($e);
        }
    }
   
    //Crear un crucero
    public function create($objeto)
	{
		try {
			if (isset($objeto->password) && $objeto->password != null) {
				$crypt = password_hash($objeto->password, PASSWORD_BCRYPT);
				$objeto->password = $crypt;
			}
			//Consulta sql            
			$vSql = "Insert into cruise (id,name,imagen,dayCount,destinationId,shipId,startDate1,startDate2,paymentDeadline,state)" .
				" Values ('$objeto->id','$objeto->name','$objeto->imagen','$objeto->dayCount','$objeto->destinationId','$objeto->shipId','$objeto->startDate1','$objeto->startDate2','$objeto->paymentDeadline','$objeto->state')";

			//Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML_last($vSql);
			// Retornar el objeto creado
			return $this->get($vResultado);
		} catch (Exception $e) {
			handleException($e);
		}
	}

    //Actualizar un crucero
    public function update($objeto)
    {
        try {
            //Consulta sql
            $sql = "UPDATE cruise SET name ='$objeto->name',"."photo ='$objeto->photo',dayCount ='$objeto->dayCount', destinationId='$objeto->destinationId', shipID='$objeto->shipId', startDate='$objeto->startDate', paymentDeadline='$objeto->paymentDeadline', state ='$objeto->state'".
                " WHERE id=$objeto->id";

            //Ejecutar la consulta
            $cResults = $this->enlace->executeSQL_DML($sql);

            //Retornar crucero
            return $this->get($objeto->id);
        } catch (Exception $e) {
            handleException($e);
        }
    }

    //Eliminar un crucero
    public function delete($id) {
		try {
			// Consulta SQL
			$sql = "UPDATE cruise SET state = FALSE WHERE id=$id";
	
			// Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML($sql);
	
			// Retornar los puertos disponibles
			return $this->all();
		} catch (Exception $e) {
			handleException($e);
		}
	}


    public function getCountByPort()
    {
        try {

            $vResultado = null;
            //Consulta sql
            $vSql = "SELECT count(cp.port_id) as 'Cantidad', p.name as 'Puerto'
			FROM port p, cruise_port cp, cruise c
			where cp.cruise_id=c.id and cp.port_id=p.id
			group by cp.port_id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
