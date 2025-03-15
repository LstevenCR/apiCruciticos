<?php
class RoomModel
{
    public $enlace;
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
    /*Listar */

	//Obtener todas las habitaciones
    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM room where state = TRUE";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ($vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }
    /*Obtener */
	//Obtener habitaciones por ID
    public function get($id)
    {
        try {

			$shipM=new shipModel();
            //Consulta sql
			$vSql = "SELECT * FROM room where id=$id && state = TRUE";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
			$vResultado=$vResultado[0];
			

            //barco
            $ship=$shipM->get($vResultado->shipId);
            $vResultado->ship=$ship; 


            // Retornar el objeto
            return $vResultado;

		} catch (Exception $e) {
            handleException($e);
        }
    }
    


    public function getRoomCruise($idCruise){
        try {
            //Consulta sql
			$vSql = "SELECT r.id,r.name,r.price
            FROM room r, cruise_room cr 
            where cr.room_id=r.id and cr.cruise_id=$idCruise";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
	public function getCruisesbyRoom($param){
        try {
			$vResultado =null;
			if(!empty($param )){
				$vSql="SELECT c.id, c.name, c.imagen, c.dayCount, c.destinationId, c.shipId, c.startDate1, c.startDate2, c.paymentDeadline
				FROM cruise_room cr, cruise c
				where cr.cruise_id = c.id and cp.room_id=$param";
				$vResultado = $this->enlace->ExecuteSQL ( $vSql);
			}
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }




	//Crear habitacion
    public function create($objeto)
	{
		try {
			if (isset($objeto->password) && $objeto->password != null) {
				$crypt = password_hash($objeto->password, PASSWORD_BCRYPT);
				$objeto->password = $crypt;
			}
			//Consulta sql            
			$vSql = "Insert into room (id,name,description,minGuests,maxGuests,size,shipId,price)" .
				" Values ('$objeto->id','$objeto->name','$objeto->description','$objeto->minGuests','$objeto->maxGuests','$objeto->size','$objeto->shipId','$objeto->price')";

			//Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML_last($vSql);
			// Retornar el objeto creado
			return $this->get($vResultado);
		} catch (Exception $e) {
			handleException($e);
		}
	}

	//Actualizar habitacion
	public function update($objeto)
    {
        try {
            //Consulta sql
            $sql = "Update room SET name ='$objeto->name'," .
                "description ='$objeto->description', minGuests ='$objeto->minGuests', maxGuests ='$objeto->maxGuests', size ='$objeto->size', shipId ='$objeto->shipId', price ='$objeto->price', state ='$objeto->state'" .
                " Where id=$objeto->id";

            //Ejecutar la consulta
            $cResults = $this->enlace->executeSQL_DML($sql);

            //Retornar habitacion
            return $this->get($objeto->id);
        } catch (Exception $e) {
            handleException($e);
        }
    }

	//Eliminar habitacion
    public function delete($id) {
		try {
			// Consulta SQL
			$sql = "UPDATE room SET state = FALSE WHERE id=$id";
	
			// Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML($sql);
	
			// Retornar las habitaciones disponibles
			return $this->all();
		} catch (Exception $e) {
			handleException($e);
		}
	}
}
