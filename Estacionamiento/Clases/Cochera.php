<?php

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
}