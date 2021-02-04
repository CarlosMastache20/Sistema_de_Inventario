<?php

//Modelo de clase Usuario
class Usuario {
    private $usuario;
    private $contrasenia;
    private $contraseniaC;
    private $email;
    private $id_sucursal;
    private $id_puesto;

    public function _construct() {
        $this->usuario = "";
        $this->contrasenia = "";
        $this->email = "";
        $this->contraseniaC = "";
        $this->id_puesto = 0;
        $this->id_sucursal = 0;
    }

    public function get_Usuario() {
        return $this->usuario;
    }
    
    public function set_Usuario($user)
    {
        $this->usuario = $user;
        return 0;    
    }

    public function get_Contrasenia() {
        return $this->contrasenia;
    }

    public function set_Contrasenia($pwd)
    {
        $this->contrasenia = $pwd;
        return 0;    
    }

    public function get_ContraseniaC() {
        return $this->contraseniaC;
    }

    public function set_ContraseniaC($contraseniaC)
    {
        $this->contraseniaC = $contraseniaC;
        return 0;    
    }

    public function get_Correo() {
        return $this->email;
    }

    public function set_Correo($correo)
    {
        $this->email = $correo;
        return 0;    
    }

    public function get_Puesto() {
        return $this->id_puesto;
    }

    public function set_Puesto($puesto)
    {
        $this->id_puesto = $puesto;
        return 0;    
    }

    public function get_Sucursal() {
        return $this->id_sucursal;
    }

    public function set_Sucursal($sucursal)
    {
        $this->id_sucursal = $sucursal;
        return 0;    
    }

}

?>