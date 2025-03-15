<?php
class AddonModel
{
    public $enlace;
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    //Ver todos lo complementos
    public function all()
    {
        try {
            //Consulta sql
            $vSql = "SELECT * FROM addon where state = TRUE";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Ver los complementos por ID
    public function get($id)
	{
		try {
			//$rolM = new RolModel();

			//Consulta sql
			$vSql = "SELECT * FROM addon where id=$id && state = TRUE";
			//Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);
			if ($vResultado) {
				$vResultado = $vResultado[0];
				//$rol = $rolM->getRolUser($id);
				//$vResultado->rol = $rol;
				// Retornar el objeto
				return $vResultado;
			} else {
				return null;
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

    //Crear complementos
    public function create($objeto)
	{
		try {
			if (isset($objeto->password) && $objeto->password != null) {
				$crypt = password_hash($objeto->password, PASSWORD_BCRYPT);
				$objeto->password = $crypt;
			}
			//Consulta sql            
			$vSql = "Insert into addon (id,name,description,price,addonType)" .
				" Values ('$objeto->id','$objeto->name','$objeto->description','$objeto->price','$objeto->addonType')";

			//Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML_last($vSql);
			// Retornar el objeto creado
			return $this->get($vResultado);
		} catch (Exception $e) {
			handleException($e);
		}
	}

    //Actualizar complementos
    public function update($objeto)
    {
        try {
            //Consulta sql
            $sql = "Update addon SET name ='$objeto->name'," .
                "description ='$objeto->description', price ='$objeto->price', addonType ='$objeto->addonType', state ='$objeto->state'".
                " Where id=$objeto->id";

            //Ejecutar la consulta
            $cResults = $this->enlace->executeSQL_DML($sql);

            //Retornar pelicula
            return $this->get($objeto->id);
        } catch (Exception $e) {
            handleException($e);
        }
    }

    //Eliminar complementos
    public function delete($id) {
		try {
			// Consulta SQL
			$sql = "UPDATE addon SET state = FALSE WHERE id=$id";
	
			// Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML($sql);
	
			// Retornar los puertos disponibles
			return $this->all();
		} catch (Exception $e) {
			handleException($e);
		}
	}
}
