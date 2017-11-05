<?php

class RegistroUsuarios
{
    private $_id;
	private $_idUsuario;
	private $_login;
	private $_logout;
	
	function __construct($id,$idUser,$login,$logout)
	{
		$this->_id = $id;
		$this->_idUsuario = $idUser;
		$this->_login = $login;
		$this->_logout = $logout;
	}
	public function GetId()
	{
		return $this->_id;
	}
	public function GetIdUser()
	{
		return $this->_idUsuario;
	}
	public function GetLogin()
	{
		return $this->_login;
	}
	public function GetLogout()
	{
		return $this->_logout;
	}
	public function SetLogin($fecha)
	{
		$this->_login = $fecha;
	}
	public function SetLogout($fecha)
	{
		$this->_logout = $fecha;
	}
}