<?php
class PortModel
{
    public $enlace;
    public function __construct()
    {

        $this->enlace = new MySqlConnect();
    }

    //Obtener todos los puertos
    public function all()
    {
        try {
            //Consulta sql
            $vSql = "SELECT * FROM port where state = TRUE";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Obtener los puertos por ID
    public function get($id)
    {
        try {
            //Consulta sql
            $vSql = "SELECT * FROM port where id=$id && state = TRUE";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            // Retornar el objeto
            return $vResultado[0];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function getPortCruise($idCruise){
        try {
            //Consulta sql
			$vSql = "SELECT p.id,p.name,p.horaSalida,p.horaLlegada
            FROM port p,cruise_ports cp 
            where cp.port_id=p.id and cp.cruise_id=$idCruise";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }
	public function getCruisesbyPort($param){
        try {
			$vResultado =null;
			if(!empty($param )){
				$vSql="SELECT c.id, c.name, c.imagen, c.dayCount, c.destinationId, c.shipId, c.startDate1, c.startDate2, c.paymentDeadline
				FROM cruise_ports cp, cruise c
				where cp.cruise_id=c.id and cp.port_id=$param";
				$vResultado = $this->enlace->ExecuteSQL ( $vSql);
			}
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }



    //Crear puertos
    public function create($objeto)
	{
		try {
			if (isset($objeto->password) && $objeto->password != null) {
				$crypt = password_hash($objeto->password, PASSWORD_BCRYPT);
				$objeto->password = $crypt;
			}
			//Consulta sql            
			$vSql = "Insert into port (id,name,country,destinationId)" .
				" Values ('$objeto->id','$objeto->name','$objeto->country','$objeto->destinationId')";

			//Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML_last($vSql);
			// Retornar el objeto creado
			return $this->get($vResultado);
		} catch (Exception $e) {
			handleException($e);
		}
	}

    //Actualizar puertos
    public function update($objeto)
    {
        try {
            //Consulta sql
            $sql = "Update port SET name ='$objeto->name'," .
                "country ='$objeto->country', destinationId ='$objeto->destinationId', state ='$objeto->state'" .
                " Where id=$objeto->id";

            //Ejecutar la consulta
            $cResults = $this->enlace->executeSQL_DML($sql);

            //Retornar puerto
            return $this->get($objeto->id);
        } catch (Exception $e) {
            handleException($e);
        }
    }
  

    //Eliminar puertos
    public function delete($id) {
		try {
			// Consulta SQL
			$sql = "UPDATE port SET state = FALSE WHERE id=$id";
	
			// Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML($sql);
	
			// Retornar los puertos disponibles
			return $this->all();
		} catch (Exception $e) {
			handleException($e);
		}
	}
}
