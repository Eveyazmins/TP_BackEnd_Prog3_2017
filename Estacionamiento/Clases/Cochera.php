<?php

require_once 'AccesoDatos.php';

class Cochera
{
#ATRIBUTOS------------------------------------------------------------------------------------------------------------
    private $_idCochera;
    private $_idPiso;
	private $_ocupado;
	private $_discapacitado;

	#CONSTRUCTOR------------------------------------------------------------------------------------------------------------
	function __construct($piso,$idCochera,$ocupado,$discapacitado)
	{
		$this->_idPiso = $piso;
		$this->_idCochera = $idCochera;
		$this->_ocupado = $ocupado;
		$this->_discapacitado = $discapacitado;		
	}

	#GETTERS Y SETTERS------------------------------------------------------------------------------------------------------
	public function GetPiso()
	{
		return $this->_idPiso;
	}
	public function GetLugar()
	{
		return $this->_idCochera;
	}
	public function GetOcupado()
	{
		return $this->_ocupado;
	}
	public function GetDiscapacitado()
	{
		return $this->_discapacitado;
	}

	#FUNCIONES DB
	
		#OCUPAR LUGAR EN LA TABLA COCHERA ---------------------------------------------------------------------------- 
		public static function OcuparLugar($id)
		{
			$resultado = false;

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE Cochera SET ocupado=:ocupado WHERE id_cochera=:idCochera"); 			
			$consulta->bindValue('idCochera',$vehiculo->_idCochera, PDO::PARAM_STR); 
			$consulta->bindValue(':ocupado',true);
			$consulta->bindValue(':idCochera',$id);
			if ($consulta->execute())
			{
				$resultado = true;
			}
			return $resultado;
		}

	
	#LIBERAR LUGAR EN LA TABLA COCHERA ----------------------------------------------------------------------------------------------------------
	public static function LiberarLugar($id)
	{
		$resultado = false;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE Cochera SET ocupado=:ocupado WHERE id_cochera=:idCochera");
		$consulta->bindValue(':ocupado',false);
		$consulta->bindValue(':idCochera',$id);
		if($consulta->execute())
		{
			$resultado = true;
		}
		return $resultado;
	}

	#LUGARES LIBRES POR PISO-----------------------------------------------------------------------------------------------------------
	public static function LugaresLibres($piso)
	{
		$datos = "";
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM Cochera WHERE piso = :piso");
		$consulta->bindValue(':piso',$piso);
		$consulta->execute();
		
		while($linea = $consulta->fetch(PDO::FETCH_ASSOC)) //mientras que siga obteniendo lineas
		{
			if ($linea["ocupado"] != true)
			{
				$datos.="<option>".$linea["id_cochera"]."</option>"; //.= concatena
			}
		}
		echo $datos;
	}

	#CARGA COCHERAS ----------------------------------------------------------------------------------------------------------

	//ver de acuerdo a lo que se pide en el enunciado

	public static function PrimerUso()
	{
		$resultado = "ErrorCarga";
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO Cochera (piso,id_cochera,ocupado,discapacitado)VALUES(:piso,:idCochera,:ocupado,:discapacitado)");
		$piso1 = 100;
		$piso2 = 200;
		$piso3 = 300;
		for ($i = 1 ; $i <= 30 ; $i++)
		{
			if($i < 4)
			{
				$consulta->bindValue(':discapacitado',true);
			}else
			{
				$consulta->bindValue(':discapacitado',false);
			}
			$num = $piso1+$i;
			$consulta->bindValue(':piso',1);
			$consulta->bindParam(':idCochera',$num);
			$consulta->bindValue(':ocupado',false);
			$resultado=$consulta->execute();
		}
		for ($i = 1 ; $i <= 30 ; $i++)
		{
			if($i < 4)
			{
				$consulta->bindValue(':discapacitado',true);
			}else
			{
				$consulta->bindValue(':discapacitado',false);
			}
			$num = $piso2+$i;
			$consulta->bindValue(':piso',2);
			$consulta->bindValue(':idCochera',$num);
			$consulta->bindValue(':ocupado',false);
			$resultado=$consulta->execute();
		}
		for ($i = 1 ; $i <= 30 ; $i++)
		{
			if($i < 4)
			{
				$consulta->bindValue(':discapacitado',true);
			}else
			{
				$consulta->bindValue(':discapacitado',false);
			}
			$num = $piso3+$i;
			$consulta->bindValue(':piso',3);
			$consulta->bindValue(':idCochera',$num);
			$consulta->bindValue(':ocupado',false);
			$resultado=$consulta->execute();
		}
		return $resultado;
	}




	

	



}