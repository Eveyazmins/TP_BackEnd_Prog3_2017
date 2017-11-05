<?php

class RegistroAutos
{
    #ATRIBUTOS--------------------------------------------------------------------------------------------------------------
	private $_id_cochera;
	private $_idUsuario;
	private $_patente;
    private $_entrada;
    private $_salida;
	private $_monto;

	#CONSTRUCTOR-------------------------------------------------------------------------------------------------------------
	function __construct($lugar,$usuario,$patente,$entrada,$salida,$monto)
	{
		$this->_idLugar = $lugar;
		$this->_idUsuario = $usuario;
		$this->_patente = $patente;
		$this->_entrada = $entrada;
		$this->_salida= $salida;
		$this->_monto = $monto;
	}

	#GETTERS Y SETTERS-------------------------------------------------------------------------------------------------------
	public function GetLugar()
	{
		return $this->_idCochera;
	}
	public function GetUsuario()
	{
		return $this->_idUsuario;
	}
	public function GetPatente()
	{
		return $this->_patente;
	}
	public function GetMonto()
	{
		return $this->_monto;
	}
	public function GetEntrada()
	{
		return $this->_entrada;
	}
	public function GetSalida()
	{
		return $this->_salida;
	}
}