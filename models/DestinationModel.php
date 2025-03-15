<?php
class DestinationModel
{
    //Conectarse a la BD
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
    /**
     * Listar peliculas
     * @param 
     * @return $vResultado - Lista de objetos
     */

    // Ver todos los destinos
    public function all()
	{
		try {
            

			//Consulta sql
			$vSql = "SELECT * FROM destination where state = TRUE";

			//Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);

			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


 
    // Obtener los destinos por ID
	public function get($id)
	{
		try {
			 

			//Consulta sql
			$vSql = "SELECT * FROM destination where id=$id && state = TRUE";
			//Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);
			if ($vResultado) {
				$vResultado = $vResultado[0];
				
               
    
               
				return $vResultado;
			} else {
				return null;
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

    
    //Actualizar los destinos
    public function update($objeto)
    {
        try {
            //Consulta sql
            $sql = "Update destination SET name ='$objeto->name', state ='$objeto->state'". 
            "Where id=$objeto->id";

            //Ejecutar la consulta
            $cResults = $this->enlace->executeSQL_DML($sql);

            //Retornar destino
            return $this->get($objeto->id);
        } catch (Exception $e) {
            handleException($e);
        }
    }
    

    //Crear destinos
    public function create($objeto)
	{
		try {
			if (isset($objeto->password) && $objeto->password != null) {
				$crypt = password_hash($objeto->password, PASSWORD_BCRYPT);
				$objeto->password = $crypt;
			}
			//Consulta sql            
			$vSql = "Insert into destination (id,name)" .
				" Values ('$objeto->id','$objeto->name')";

			//Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML_last($vSql);
			// Retornar el objeto creado
			return $this->get($vResultado);
		} catch (Exception $e) {
			handleException($e);
		}
	}

    //Eliminar los deestino
    public function delete($id) {
		try {
			// Consulta SQL
			$sql = "UPDATE destination SET state = FALSE WHERE id=$id";
	
			// Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML($sql);
	
			// Retornar los puertos disponibles
			return $this->all();
		} catch (Exception $e) {
			handleException($e);
		}
	}
}
