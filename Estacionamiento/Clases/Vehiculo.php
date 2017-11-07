<?php

include_once "Cochera.php";
include_once "Registro_autos.php";
include_once "usuario.php";
require_once 'AccesoDatos.php';

class Vehiculo
{
	#ATRIBUTOS-----------------------------------------------------------------------
	private $_idCochera;
	private $_color;
	private $_patente;
	private $_marca;
    private $_horaIngreso;
    private $_fechaIngreso;

	#CONSTRUCTOR---------------------------------------------------------------------
	function __construct($patente,$idCochera,$marca=null,$color=null,$hora=null,$fecha=null)
	{
		$this->_patente = $patente;
		$this->_color = $color;
		$this->_marca = $marca;
		$this->_idCochera = $idCochera;
		$this->_horaIngreso = $hora;
	}

	#GETTERS Y SETTERS---------------------------------------------------------------
	public function GetId()
	{
		return $this->_idCochera;
	}
	#--------------------------------------------------------------------------------
	public function GetHora()
	{
		return $this->_horaIngreso;
	}
	#--------------------------------------------------------------------------------
	public function GetColor()
	{
		return $this->_color;
	}
	public function SetColor($color)
	{
		$this->_color = $color;
	}
	#--------------------------------------------------------------------------------
	public function GetPatente()
	{
		return $this->_patente;
	}
	public function SetPatente($patente)
	{
		$this->_patente = $patente;
	}
	#--------------------------------------------------------------------------------
	public function GetMarca()
	{
		return $this->_marca;
	}
	public function SetMarca($marca)
	{
		$this->_marca = $marca;
    }

    #FUNCIONES DB ---------------------------------------------------------------------------------------------------

    #INSERTAR VEHICULO EN DB
    
    public static function IngresarAuto($vehiculo)
	{
		$patente = Vehiculo::ValidarPatente($vehiculo->GetPatente());
		if( $patente != FALSE)
		{
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into Vehiculo (id_cochera,patente,marca,color,hora,fecha) values (:idCochera,:patente,:marca,:color,:hora,:fecha)"); 			
			$consulta->bindValue(':idCochera',$vehiculo->_idCochera, PDO::PARAM_STR); 
			$consulta->bindValue(':patente',$vehiculo->_patente, PDO::PARAM_STR);
			$consulta->bindValue(':marca',$vehiculo->_marca, PDO::PARAM_STR);
			$consulta->bindValue(':color',$vehiculo->_color, PDO::PARAM_STR);
			$consulta->bindValue(':fecha',$vehiculo->_fecha, PDO::PARAM_STR);
			$consulta->bindValue(':hora',$vehiculo->_hora, PDO::PARAM_STR);
			$consulta->execute();

			Cochera::OcuparLugar($obj->GetId());
			//$resultado = Vehiculo::TablaEstacionados();
			$resultado = $objetoAccesoDato->RetornarUltimoIdInsertado();	
		}
		else
		{
			$resultado = "Patente no valida";
		}
		return $resultado;		
	}

	#ELIMINAR VEHICULO EN DB ----------------------------------------------------------------------------------------
	
	public static function RetirarAuto($patente)
	{
		$patente = Vehiculo::ValidarPatente($vehiculo->GetPatente());
		if( $patente != FALSE)
		{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
			$consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM Vehiculo WHERE patente = :patente");	
			$consulta->bindValue(':patente',$patente);		
			$consulta->execute();
			$resultado = $consulta->rowCount();

			$consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM Vehiculo WHERE patente = :patente");
			$consulta->bindValue(':patente',$patente);
			$consulta->execute();

			$resultado = $resultado - $consulta->rowCount();
		
			if($resultado != 0)
			{
				$cochera = Cochera::LiberarLugar(ObtenerIdCochera($patente));
				return "Cantidad filas modificadas = ".$resultado."\n.Cochera".$cochera." liberada.";
			}
		}
		else
		{
			$resultado = "Patente no valida";
		}
	}

	public static function ObtenerIdCochera($patente)
	{
		$cochera = "Error";
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM Vehiculo WHERE patente = :patente");
		$consulta->bindValue(':patente',$patente);
		$consulta->execute();

		while($linea = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$cochera = $linea["id_cochera"];
		}
		return $cochera;
	}


	# CALCULA MONTO DE COBRO POR HORAS TRANSCURRIDAS --------------------------------------------------------------------
	
	public static function CalcularMonto($tiempo)
	{
		$actual = time();
		$tiempo = $actual - $tiempo;
		$horas = round(($tiempo/60)/60,2);

		switch ($horas) 
		{
			case ($horas <= 9):
				$valor = $horas*10;
				break;
			case ($horas > 9 && $horas < 12):
				$valor = 90;
				break;
			case ($horas >12 && $horas <16):
				$diferencia = $horas -12;
				$valor = 90 + ($diferencia * 10);
				break;
			case ($horas > 16 && $horas <= 24):
				$valor = 170;
				break;
			case ($horas > 24):
				$diferencia = $horas -24;
				$valor = 170 + ($diferencia * 10);
				break;
			default:
				break;
		}
		
		return $valor;
	}


}