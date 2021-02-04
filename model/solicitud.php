<?php

//Modelo para Producto

class Solicitud
{
    private $nombre;
    private $cantidad;
    private $id_sucursal;
    private $sucursal;
    private $id_producto;
    private $codigo_prestamo;
    private $detalles;

    public function _construct(){
        $this->nombre = "";
        $this->cantidad = 0;
        $this->id_sucursal = 0;
        $this->sucursal = "";
        $this->id_producto = 0;
        $this->codigo_prestamo = 0;
        $this->detalles = 0;
    }

    public function get_Nombre(){
        return $this->nombre;
    }

    public function set_Nombre($Nombre_S){
        $this->nombre = $Nombre_S;
        return 0; 
    }

    public function get_Detalles(){
        return $this->detalles;
    }

    public function set_Detalles($Detalles_S){
        $this->detalles = $Detalles_S;
        return 0; 
    }

    public function get_Cantidad(){
        return $this->cantidad;
    }

    public function set_Cantidad($cantidad_S){
        $this->cantidad = $cantidad_S;
        return 0; 
    }

    public function get_Id_Sucursal(){
        return $this->id_sucursal;
    }

    public function set_Id_Sucursal($Id_S){
        $this->id_sucursal = $Id_S;
        return 0; 
    }
    public function get_Id_producto(){
        return $this->id_producto;
    }

    public function set_Id_producto($Id__Producto_S){
        $this->id_producto = $Id__Producto_S;
        return 0; 
    }


    public function get_Sucursal(){
        return $this->sucursal;
    }

    public function set_Sucursal($Sucursal_S){
        $this->sucursal = $Sucursal_S;
        return 0; 
    }

    public function get_Codigo_prestamo(){
        return $this->codigo_prestamo;
    }

    public function set_Codigo_prestamo($CodigoPrestamo_S){
        $this->codigo_prestamo = $CodigoPrestamo_S;
        return 0; 
    }

    
}

?>