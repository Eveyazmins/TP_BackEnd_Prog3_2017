<?php

class Usuario
{
    class Usuario
    {
        #ATRIBUTOS-----------------------------------------------------------------------------------
        private $_id;
        private $_password;
        private $_nombre;
        private $_apellido;
        private $_tipoUsuario;
        private $_turno;
        private $_habilitado;
    
        #CONSTRUCTOR---------------------------------------------------------------------------------
        function __construct($nombre,$password,$apellido,$tipo,$turno,$id=null,$habilitado=1)
        {
            $this->_id = $id;
            $this->_nombre = $nombre;
            $this->_password = $password;
            $this->_apellido = $apellido;
            $this->_tipoUsuario = $tipo;
            $this->_turno = $turno;
            $this->_habilitado = $habilitado;

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
}