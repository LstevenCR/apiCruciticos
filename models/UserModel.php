<?php

use Firebase\JWT\JWT;

class UserModel
{
	public $enlace;
	public function __construct()
	{
		$this->enlace = new MySqlConnect();
	}

	//Obtener todos los usuario
	public function all()
	{
		try {
			//Consulta sql
			$vSql = "SELECT * FROM user where state = TRUE";

			//Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);

			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	//Obtener usuarios por ID
	public function get($id)
	{
		try {
			//$rolM = new RolModel();

			//Consulta sql
			$vSql = "SELECT * FROM user where id=$id && state = TRUE";
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

	//Crear usuario
	public function create($objeto)
	{
		try {
			if (isset($objeto->password) && $objeto->password != null) {
				$crypt = password_hash($objeto->password, PASSWORD_BCRYPT);
				$objeto->password = $crypt;
			}
			//Consulta sql            
			$vSql = "Insert into user (id,name,phone,email,password,birthDate,role,country)" .
				" Values ('$objeto->id','$objeto->name','$objeto->phone','$objeto->email','$objeto->password','$objeto->birthDate','$objeto->role','$objeto->country')";

			//Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML_last($vSql);
			// Retornar el objeto creado
			return $this->get($vResultado);
		} catch (Exception $e) {
			handleException($e);
		}
	}

	

	//Actualizar usuario
	public function update($objeto) {
        try {
            //Consulta sql
            $sql = "Update user SET name ='$objeto->name'," .
                "phone ='$objeto->phone', email ='$objeto->email', password ='$objeto->password', birthDate ='$objeto->birthDate', role ='$objeto->role', country ='$objeto->country', state ='$objeto->state'" .
                " Where id=$objeto->id";

            //Ejecutar la consulta
            $cResults = $this->enlace->executeSQL_DML($sql);

            //Retornar usuario
            return $this->get($objeto->id);
        } catch (Exception $e) {
            handleException($e);
        }
    }

	//Eliminar usuario
	public function delete($id) {
		try {
			// Consulta SQL
			$sql = "UPDATE user SET state = FALSE WHERE id=$id";
	
			// Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML($sql);
	
			// Retornar el los usuarios disponibles
			return $this->all();
		} catch (Exception $e) {
			handleException($e);
		}
	}
}