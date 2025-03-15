<?php
class PaymentModel{
    public $enlace;
    public function __construct() {
        
        $this->enlace=new MySqlConnect();
       
    }

    //Obtener todos los pagos
    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM payment where state = TRUE";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            if(!empty($vResultado) && is_array($vResultado)){
                for ($i=0; $i <= count($vResultado)-1; $i++) { 
                    $vResultado[$i]=$this->get($vResultado[$i]->id);
                }
                
            }
			// Retornar el objeto
			return $vResultado;
		} catch ( Exception $e ) {
			die ( $e->getMessage () );
		}
    }

    //Obtener pago por ID
    public function get($id)
	{
		try {
			//$rolM = new RolModel();

			//Consulta sql
			$vSql = "SELECT * FROM payment where id=$id && state = TRUE";
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


    //Crear pagos
    public function create($objeto)
	{
		try {
			if (isset($objeto->password) && $objeto->password != null) {
				$crypt = password_hash($objeto->password, PASSWORD_BCRYPT);
				$objeto->password = $crypt;
			}
			//Consulta sql            
			$vSql = "Insert into payment (id,amount,paymentDate,paymentMethod,reservationId)" .
				" Values ('$objeto->id','$objeto->amount','$objeto->paymentDate','$objeto->paymentMethod','$objeto->reservationId')";

			//Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML_last($vSql);
			// Retornar el objeto creado
			return $this->get($vResultado);
		} catch (Exception $e) {
			handleException($e);
		}
	}


    //Actualizar pagos
    public function update($objeto)
    {
        try {
            //Consulta sql
            $sql = "Update payment SET amount ='$objeto->amount'," .
                "paymentDate ='$objeto->paymentDate', paymentMethod ='$objeto->paymentMethod', reservationId ='$objeto->reservationId', state ='$objeto->state'" .
                " Where id=$objeto->id";

            //Ejecutar la consulta
            $cResults = $this->enlace->executeSQL_DML($sql);

            //Retornar pelicula
            return $this->get($objeto->id);
        } catch (Exception $e) {
            handleException($e);
        }
    }

    //Eliminar los pagos
    public function delete($id) {
		try {
			// Consulta SQL
			$sql = "UPDATE payment SET state = FALSE WHERE id=$id";
	
			// Ejecutar la consulta
			$cResults = $this->enlace->executeSQL_DML($sql);
	
			// Retornar los pagos disponibles
			return $this->all();
		} catch (Exception $e) {
			handleException($e);
		}
	}
}