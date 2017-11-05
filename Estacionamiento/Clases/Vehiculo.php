<?php

include_once "Cochera.php";
include_once "Registro_autos.php";
include_once "usuario.php";

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

    #FUNCIONES DB --------------------------------------------------------------------

    #INSERTAR AUTO EN DB
    
    public static function IngresarAuto($vehiculo)
	{
		$patente = Vehiculo::ValidarPatente($vehiculo->GetPatente());
		if( $patente != FALSE)
		{
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into Vehiculo (id_cochera,patente,marca,color,hora,fecha) values (:patente,:fecha,:hora) ");
			
			$db = $pdo->prepare("INSERT INTO autos (id_lugar,patente,marca,color,hora)VALUES(:idLugar,:patente,:marca,:color,:hora)");
			$db->bindValue(':patente',$patente);
			$db->bindValue(':marca',$obj->GetMarca());
			$db->bindValue(':color',$obj->GetColor());
			$db->bindValue(':hora',$obj->GetHora());
			$db->bindValue(':idLugar',$obj->GetId());
			if($db->execute() && Lugares::OcuparLugar($obj->GetId()))
				{
					$resultado = Vehiculo::TablaEstacionados();
				}
		}
		else
		{
			$resultado = "errorpat";
		}
		return $resultado;		
	}
    
    
    $consulta->bindValue(':patente',$vehiculo->patente, PDO::PARAM_STR);
    $consulta->bindValue(':fecha',$vehiculo->fecha, PDO::PARAM_STR);
    $consulta->bindValue(':hora',$vehiculo->hora, PDO::PARAM_STR);
    $consulta->execute();
    return $objetoAccesoDato->RetornarUltimoIdInsertado();






}