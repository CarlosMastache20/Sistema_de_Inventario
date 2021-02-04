<?php
//Conexión a la base de datos MYSQL

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "papeleria";



//SQL para seleccionar a los usuarios
$sql_autenticar = "SELECT usuario, contrasenia, id_puesto, id_sucursal FROM personas";

//Campos de autenticación
$campo01_user = "usuario";
$campo02_pwd = "contrasenia";

//SQL para llenar la tabla de Inventario de Reforma
$sql_inventario_Reforma = "SELECT nombre, marca, precio, categoria, existencia, Sucursal, id_inventario FROM productos 
    INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria 
    INNER JOIN inventarios ON productos.id_producto=inventarios.Id_producto 
    INNER JOIN sucursales ON sucursales.id_sucursal=inventarios.Id_sucursal WHERE Sucursal = 'Reforma'";

//SQL para llenar la tabla de Inventario de Xoxocotlan
$sql_inventario_Xoxocotlan = "SELECT nombre, marca, precio, categoria, existencia, Sucursal, id_inventario FROM productos 
    INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria 
    INNER JOIN inventarios ON productos.id_producto=inventarios.Id_producto 
    INNER JOIN sucursales ON sucursales.id_sucursal=inventarios.Id_sucursal WHERE Sucursal = 'Xoxocotlan'";

//SQL para llenar la tabla de Inventario de Simbolos Patrios
$sql_inventario_Simbolos_Patrios = "SELECT nombre, marca, precio, categoria, existencia, Sucursal, id_inventario FROM productos 
    INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria 
    INNER JOIN inventarios ON productos.id_producto=inventarios.Id_producto 
    INNER JOIN sucursales ON sucursales.id_sucursal=inventarios.Id_sucursal WHERE Sucursal = 'Simbolos Patrios'";

//SQL para llenar la tabla de Inventario de Zimatlan
$sql_inventario_Zimatlan = "SELECT nombre, marca, precio, categoria, existencia, Sucursal, id_inventario FROM productos 
    INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria 
    INNER JOIN inventarios ON productos.id_producto=inventarios.Id_producto 
    INNER JOIN sucursales ON sucursales.id_sucursal=inventarios.Id_sucursal WHERE Sucursal = 'Zimatlan'";

//SQL para llenar la tabla de Inventario de Matriz
$sql_inventario_Matriz = "SELECT nombre, marca, precio, categoria, existencia, Sucursal, id_inventario FROM productos 
    INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria 
    INNER JOIN inventarios ON productos.id_producto=inventarios.Id_producto 
    INNER JOIN sucursales ON sucursales.id_sucursal=inventarios.Id_sucursal WHERE Sucursal = 'Matriz'";

$sql_inventario_General = "SELECT nombre, marca, precio, inventarios.Id_producto, SUM(existencia) as existencia from inventarios 
                            INNER JOIN productos ON productos.id_producto = inventarios.Id_producto GROUP by Id_producto";


$contador1 = "SELECT COUNT(origen) FROM solicitudes where origen!= 1";
$contador2 = "SELECT COUNT(origen) FROM solicitudes where origen!= 2";
$contador3 = "SELECT COUNT(origen) FROM solicitudes where origen!= 3";
$contador4 = "SELECT COUNT(origen) FROM solicitudes where origen!= 4";
$contador5 = "SELECT COUNT(origen) FROM solicitudes where origen!= 5";


//SQL para llenar la tabla de Inventario Solicitudes de Reforma
$sql_Soli_Reforma = "SELECT id, origen, Sucursal, producto, cantidad, id_producto from solicitudes INNER JOIn sucursales ON solicitudes.origen=sucursales.id_sucursal 
INNER JOIN productos ON productos.nombre=solicitudes.producto WHERE origen!=2 and estado=0";

//SQL para llenar la tabla de Inventario Solicitudes de Xoxocotlan
$sql_Soli_Xoxocotlan = "SELECT id, origen, Sucursal, producto, cantidad, id_producto from solicitudes INNER JOIn sucursales ON solicitudes.origen=sucursales.id_sucursal 
INNER JOIN productos ON productos.nombre=solicitudes.producto WHERE origen!=4 and estado=0";

//SQL para llenar la tabla de Inventario Solicitudes de Simbolos Patrios
$sql_Soli_Simbolos_Patrios = "SELECT id, origen, Sucursal, producto, cantidad, id_producto from solicitudes INNER JOIn sucursales ON solicitudes.origen=sucursales.id_sucursal 
INNER JOIN productos ON productos.nombre=solicitudes.producto WHERE origen!=3 and estado=0";

//SQL para llenar la tabla de Inventario Solicitudes de Zimatlan
$sql_Soli_Zimatlan = "SELECT id, origen, Sucursal, producto, cantidad, id_producto from solicitudes INNER JOIn sucursales ON solicitudes.origen=sucursales.id_sucursal 
INNER JOIN productos ON productos.nombre=solicitudes.producto WHERE origen!=5 and estado=0";

//SQL para llenar la tabla de Inventario Solicitudes de Matriz
$sql_Soli_Matriz = "SELECT id, origen, Sucursal, producto, cantidad, id_producto from solicitudes INNER JOIn sucursales ON solicitudes.origen=sucursales.id_sucursal 
INNER JOIN productos ON productos.nombre=solicitudes.producto WHERE origen!=1 and estado=0";

//SQL para obtener los codigos disponibles
$sql_Obtener_codigo_Reforma = "SELECT producto, cantidad, codigo FROM solicitudes where origen=2 and estado=1";
$sql_Obtener_codigo_Xoxocotlan = "SELECT producto, cantidad, codigo FROM solicitudes where origen=4 and estado=1";
$sql_Obtener_codigo_Simbolos_Patrios = "SELECT producto, cantidad, codigo FROM solicitudes where origen=3 and estado=1";
$sql_Obtener_codigo_Zimatlan = "SELECT producto, cantidad, codigo FROM solicitudes where origen=5 and estado=1";
$sql_Obtener_codigo_Matriz = "SELECT producto, cantidad, codigo FROM solicitudes where origen=1 and estado=1";


$sql_Soli_Todas = "SELECT id, origen, Sucursal, producto, cantidad, id_producto from solicitudes INNER JOIn sucursales ON solicitudes.origen=sucursales.id_sucursal 
INNER JOIN productos ON productos.nombre=solicitudes.producto WHERE estado=0";


//obtener el ultimo id
$ultimo_id = "SELECT id_producto from productos ORDER by id_producto DESC LIMIT 1";

//SQL para llenar solicitudes de las bajas
$sql_bajas = "SELECT id, origen, Sucursal, producto, bajas.detalles, id_producto from bajas INNER JOIn sucursales ON bajas.origen=sucursales.id_sucursal 
INNER JOIN productos ON productos.nombre=bajas.producto WHERE estado=0";


//Contando las bajas que hay
$sql_contador_bajas = "SELECT COUNT(id) from bajas where estado=0";



//SQL para obtener los codigos disponibles de bajas
$sql_Obtener_codigo_Reforma_bajas = "SELECT producto, codigo FROM bajas where origen=2 and estado=1";
$sql_Obtener_codigo_Xoxocotlan_bajas = "SELECT producto, codigo FROM bajas where origen=4 and estado=1";
$sql_Obtener_codigo_Simbolos_Patrios_bajas = "SELECT producto, codigo FROM bajas where origen=3 and estado=1";
$sql_Obtener_codigo_Zimatlan_bajas = "SELECT producto, codigo FROM bajas where origen=5 and estado=1";
$sql_Obtener_codigo_Matriz_bajas = "SELECT producto, codigo FROM bajas where origen=1 and estado=1";
?>