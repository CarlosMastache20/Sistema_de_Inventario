<?php

//Modelo para Producto

class Producto
{
    private $id;
    private $nombre;
    private $marca;
    private $precio;
    private $clasificacion;
    private $existencia;
    private $id_inventario;
    private $detalles;

    public function _construct(){
        $this->id = 0;
        $this->nombre = "";
        $this->marca = "";
        $this->precio = 0;
        $this->clasificacion = "";
        $this->existencia = 0;
        $this->id_inventario = 0;
        $this->detalles = "";
    }

    public function get_Id(){
        return $this->id;
    }

    public function set_Id($id_P){
        $this->id = $id_P;
        return 0; 
    }

    public function get_Nombre(){
        return $this->nombre;
    }

    public function set_Nombre($Nombre_P){
        $this->nombre = $Nombre_P;
        return 0; 
    }

    public function get_Detalles(){
        return $this->detalles;
    }

    public function set_Detalles($Detalles_P){
        $this->detalles = $Detalles_P;
        return 0; 
    }
    
    public function get_Marca(){
        return $this->marca;
    }
    
    public function set_Marca($Marca_P){
        $this->marca = $Marca_P;
        return 0; 
    }

    public function get_Precio(){
        return $this->precio;
    }

    public function set_Precio($Precio_P){
        $this->precio = $Precio_P;
        return 0; 
    }

    public function get_Categoria(){
        return $this->clasificacion;
    }

    public function set_Categoria($Clasificacion_P){
        $this->clasificacion = $Clasificacion_P;
        return 0; 
    }

    public function get_Existencia(){
        return $this->existencia;
    }

    public function set_Existencia($Existencia_P){
        $this->existencia = $Existencia_P;
        return 0; 
    }

    public function get_Id_inventario(){
        return $this->id_inventario;
    }

    public function set_Id_inventario($id_inventario_P){
        $this->id_inventario = $id_inventario_P;
        return 0; 
    }
}

?>