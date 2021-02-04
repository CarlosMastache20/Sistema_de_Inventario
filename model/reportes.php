<?php

//Modelo para Producto

class Reportes
{
    private $categoria;
    private $cantidad;
    private $precio;

    public function _construct(){
        $this->categoria = "";
        $this->cantidad = 0;
        $this->precio = 0;
    }

    public function get_Categoria(){
        return $this->categoria;
    }

    public function set_Categoria($Categoria_R){
        $this->categoria = $Categoria_R;
        return 0; 
    }

    public function get_Cantidad(){
        return $this->cantidad;
    }

    public function set_Cantidad($cantidad_R){
        $this->cantidad = $cantidad_R;
        return 0; 
    }

    public function get_Precio(){
        return $this->precio;
    }

    public function set_Precio($Precio_R){
        $this->precio = $Precio_R;
        return 0; 
    }

    
}

?>