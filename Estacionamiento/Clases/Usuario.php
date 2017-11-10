<?php

class Usuario
{
    private $_id;
    private $_password;
    private $_nombre;
    private $_apellido;
    private $_tipoUsuario;
    private $_turno;
    private $_habilitado;
    private $_cantOperaciones;

    
    #CONSTRUCTOR---------------------------------------------------------------------
	function __construct($password,$nombre,$apellido,$tipo,$turno,$estado)
	{
        $this->_password = $password;
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_tipoUsuario = $tipo;
        $this->_turno = $turno;
        $this->_habilitado = $estado;
        $this->_cantOperaciones = 0;
    }


    #GETTERS Y SETTERS----------------------------------------------------------------------------
    public function GetId()
    {
        return $this->_id;
    }
    #---------------------------------------------------------------------------------------------
    public function GetPassword()
    {
        return $this->_password;
    }
    #---------------------------------------------------------------------------------------------
    public function GetNombre()
    {
        return $this->_nombre;
    }
    public function SetNombre($nombre)
    {
        $this->_nombre = $nombre;
    }
    #---------------------------------------------------------------------------------------------
    public function GetApellido()
    {
        return $this->_apellido;
    }
    public function SetApellido($apellido)
    {
        $this->_apellido = $apellido;
    }
    #---------------------------------------------------------------------------------------------
    public function GetTipo()
    {
        return $this->_tipoUsuario;
    }
    public function SetTipo($tipo)
    {
        $this->_tipoUsuario = $tipo;
    }
    #---------------------------------------------------------------------------------------------
    public function GetTurno()
    {
        return $this->_turno;
    }
    public function SetTurno($turno)
    {
        $this->_turno = $turno;
    }
    #---------------------------------------------------------------------------------------------
    public function GetHabilitado()
    {
        return $this->_habilitado;
    }
    public function SetHabilitado($habilito)
    {
        $this->_habilitado = $habilito;
    }


    #Metodos DB

    public static function TraerUsuarios()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM Usuario");
		$consulta->execute();			
		$arrayUsuarios= $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario"); //Devuelve un array con todas las filas recuperadas
        return $arrUsuarios;
    }

    public static function AgregarUsuario($nombre, $apellido, $password, $tipo, $turno, $estado, $cantOperaciones)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO Usuario (password,nombre,apelido,tipo_usuario,turno,habilitado,cant_operaciones) 
		values(:password,:nombre,:apellido,:tipo_usuario,:turno,:estado,:cant_operaciones)");
        $consulta->bindValue(':password', $password, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
		$consulta->bindValue(':apellido', $apellido, PDO::PARAM_STR);
		$consulta->bindValue(':tipo_usuario', $tipo, PDO::PARAM_STR);
		$consulta->bindValue(':turno', $turno, PDO::PARAM_STR);
		$consulta->bindValue(':estado', $estado, PDO::PARAM_STR);
		$consulta->bindValue(':cant_operaciones', $cantoperaciones, PDO::PARAM_STR);
		return $consulta->execute();
	}

    public static function ModificarEstado($id, $estado)
	{
        $resultado = "Datos no validos";
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE Usuario SET estado=:estado WHERE id=:id");
		$consulta->bindValue(':id',$id, PDO::PARAM_STR);
		$consulta->bindValue(':estado', $estado, PDO::PARAM_STR);
        $consulta->execute();
        if($consulta->rowCount() != 0)
        {
            $resultado = "Estado modificado";
        }
        return $resultado;
    }
    
    public static function ModificarPassword($id, $password)
    {
        $resultado = "Datos no validos";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE Usuario SET password=:password WHERE id=:id");
		$consulta->bindValue(':id',$id, PDO::PARAM_STR);
		$consulta->bindValue(':password', $password, PDO::PARAM_STR);
        $consulta->execute();
        if($consulta->rowCount() != 0)
        {
            $resultado = "Password modificada";
        }
        return $resultado;
    }


    public static function EliminarUsuario($id)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE from Usuario WHERE id=:id");	
		$consulta->bindValue(':id',$id, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
    }
    
    public static function CantidadOperaciones()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM Usuario WHERE tipo='Empleado'");
		$consulta->execute();			
		$arrayUsuarios= $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");	
		return $arrayUsuarios;
    }
    
    
	public static function ValidacionPassword($id,$pass) 
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE id =:id AND password =:password");
		$consulta->bindValue(':id', $id, PDO::PARAM_STR);
		$consulta->bindValue(':password', $pass, PDO::PARAM_STR);
		$consulta->execute();
        $resultado = $consulta->fetchObject('Usuario');
        
        if($resultado != null)
        {
            return $resultado;
        }
        else
        {
            return FALSE; //REVISAR
        }	
	}

    

}