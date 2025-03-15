<?php
class ShipModel{
    public $enlace;
    public function __construct() {
        
        $this->enlace=new MySqlConnect();
       
    }

	//Obtener todos los barcos
    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM ship where state = TRUE";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

	//Obtener barco por ID
    public function get($id){
        try {

            $roomM=new RoomModel();

            //Consulta sql
			$vSql = "SELECT * FROM ship where id=$id && state = TRUE";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            // Retornar el objeto
			$vResultado=$vResultado[0];

            //Habitación
            $room=$roomM->getRoomCruise($vResultado->id);
            $vResultado->room=$room;        


            return $vResultado;
            
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

	//Crear barco
	public function create($objeto) {
        try {
            //Consulta sql
            //Identificador autoincrementable
            
			$vSql = "Insert into genre (title) Values ('$objeto->title')";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML_last( $vSql);
			// Retornar el objeto creado
            return $this->get($vResultado);
		} catch (Exception $e) {
            handleException($e);
        }
    }

	//Actualizar barco
    public function update($objeto) {
        try {
            //Consulta sql
            $sql = "Update ship SET name ='$objeto->name'," .
                "description ='$objeto->description', guestCapacity ='$objeto->guestCapacity', availableRoomCount ='$objeto->availableRoomCount', state ='$objeto->state'" .
                " Where id=$objeto->id";

            //Ejecutar la consulta
            $cResults = $this->enlace->executeSQL_DML($sql);

            //Retornar barco
            return $this->get($objeto->id);
        } catch (Exception $e) {
            handleException($e);
        }
    }

	//Eliminar barco
    public function delete($id) {
		try {
			// Consulta SQL
			$sql = "UPDATE ship SET state = FALSE WHERE id=$id";
	
			// Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML($sql);
	
			// Retornar el los barcos disponibles
			return $this->all();
		} catch (Exception $e) {
			handleException($e);
		}
	}
}