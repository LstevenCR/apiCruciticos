<?php

use Firebase\JWT\JWT;

class ReservationModel
{
	public $enlace;
	public function __construct()
	{

		$this->enlace = new MySqlConnect();
	}

	//Obtener todas las reservaciones
	public function all()
	{
		try {
			//Consulta sql
			$vSql = "SELECT * FROM reservation where state = TRUE";

			//Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);

			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	//Obtener reservacion por ID
	public function get($id)
	{
		try {
			//Construyo instancia de crucero
			$cruiseM=new cruiseModel();
			$userM=new userModel();
			//Consulta sql
			$vSql = "SELECT * FROM reservation where id=$id && state = TRUE";


			//Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);
			if ($vResultado) {
				$vResultado = $vResultado[0];
				
				 //crucero
				 $cruise=$cruiseM->get($vResultado->cruiseId);
				 $vResultado->cruise=$cruise; 

				 //usuario
				 $user=$userM->get($vResultado->userId);
				 $vResultado->user=$user; 

				return $vResultado;
			} else {
				return null;
			}
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


	//Crear reserva
	public function create($objeto)
	{
		try {
			if (isset($objeto->password) && $objeto->password != null) {
				$crypt = password_hash($objeto->password, PASSWORD_BCRYPT);
				$objeto->password = $crypt;
			}
			//Consulta sql            
			$vSql = "Insert into reservation (id,totalAmount,status,reservationDate,userId,cruiseId)" .
			" Values ('$objeto->id','$objeto->totalAmount','$objeto->status','$objeto->reservationDate','$objeto->userId','$objeto->cruiseId')";
			//Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML_last($vSql);
			// Retornar el objeto creado
			return $this->get($vResultado);
		} catch (Exception $e) {
			handleException($e);
		}
	}

	//Actualizar una reserva
	public function update($objeto)
    {
        try {
            //Consulta sql
            $sql = "Update reservation SET totalAmount ='$objeto->totalAmount'," .
                "status ='$objeto->status', reservationDate ='$objeto->reservationDate', userId ='$objeto->userId', cruiseId ='$objeto->cruiseId', state ='$objeto->state'" .
                " Where id=$objeto->id";

            //Ejecutar la consulta
            $cResults = $this->enlace->executeSQL_DML($sql);

            //Retornar reserva
            return $this->get($objeto->id);
        } catch (Exception $e) {
            handleException($e);
        }
    }

	//Eliminar una reserva
	public function delete($id) {
		try {
			// Consulta SQL
			$sql = "UPDATE reservation SET state = FALSE WHERE id=$id";
	
			// Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML($sql);
	
			// Retornar las reservas disponibles
			return $this->all();
		} catch (Exception $e) {
			handleException($e);
		}
	}









































	//En caso de ser necesario:


		/*
	public function customerbyShopRental($idShopRental)
	{
		try {
			//Consulta sql
			$vSql = "SELECT * FROM cruciticos.reservation
					where rol_id=2 and shop_id=$idShopRental;";

			//Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);

			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
*/

		/*public function login($objeto)
	{
		try {

			$vSql = "SELECT * from user where email='$objeto->email'";

			//Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);
			if (is_object($vResultado[0])) {
				$user = $vResultado[0];
				if (password_verify($objeto->password, $user->password)) {
					$user = $this->get($user->id);
					if (!empty($user)) {
						// Datos para el token JWT
						$data = [
							'id' => $user->id,
							'email' => $user->email,
							'rol' => $user->rol,
							'iat' => time(),  // Hora de emisión
							'exp' => time() + 3600 // Expiración en 1 hora
						];

						// Generar el token JWT
						$jwt_token = JWT::encode($data, config::get('SECRET_KEY'), 'HS256');

						// Enviar el token como respuesta
						return $jwt_token;
					}
				}
			} else {
				return false;
			}
		} catch (Exception $e) {
			handleException($e);
		}
	}*/
}