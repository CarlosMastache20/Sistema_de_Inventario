<?php

include ('../../model/solicitud.php');

function msg_codigoBaja(int $Sc){
    include ('../../DB/db.php');

    //Creacion de la conexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Nuevo objeto
    $solicitud_nuevo = new Solicitud();

    //Verifica la conexion
    if($conn->connect_error){
        die("Error en la conexion: " . $conn->connect_error);
    }else{
        switch ($Sc) {
            case 1;
                $result = $conn->query($sql_Obtener_codigo_Matriz_bajas);
            break;
            case 2:
                $result = $conn->query($sql_Obtener_codigo_Reforma_bajas);
            break;
            case 3:
                $result = $conn->query($sql_Obtener_codigo_Simbolos_Patrios_bajas);
                break;
            case 4:
                $result = $conn->query($sql_Obtener_codigo_Xoxocotlan_bajas);
            break;
            case 5:
                $result = $conn->query($sql_Obtener_codigo_Zimatlan_bajas);
            break;
        }
        if($result->num_rows > 0){
            while($row=mysqli_fetch_array($result)){
                $array = array($row["producto"],$row['codigo']);
                $solicitud_nuevo->set_Nombre($array[0]);
                $solicitud_nuevo->set_Codigo_prestamo($array[1]);

                echo '
                <div class="col-lg-4">
                    <button type="button" class="btn btn-light">
                    Nuevo Código <span class="badge bg-secondary">'.$solicitud_nuevo->get_Codigo_prestamo().'</span>
                    para '.$solicitud_nuevo->get_Nombre().'  
                    </button>
                </div>
                ';

            }
        }
        $conn->close();
    }
}


function confirmar_codigo_actualizar_Baja(string $codigo, int $id_sucursal){

    if(strlen($codigo) >= 1){
        //Primero actualiza la tabla para quitar el mensaje
        $con = mysqli_connect("localhost","root","1234","papeleria");
        $con->set_charset("utf8");
        $consulta = "UPDATE bajas SET estado=2 WHERE codigo = '".$codigo."'";
        $soli = mysqli_query($con,$consulta);

        //Obtengo el producto y la cantidad para actualizar la base de datos
        $pro_cant = "SELECT producto from bajas WHERE codigo = '".$codigo."'";
        $sql_pro_cant = mysqli_query($con,$pro_cant);

        if($sql_pro_cant->num_rows > 0){
            while($row = mysqli_fetch_array($sql_pro_cant)){
                $array = array($row['producto']);

                $producto = $array[0];

                //Obtener el id de ese producto
                    $id_pro = "SELECT id_producto, nombre FROM productos where nombre = '".$producto."'";
                    $sql_id_pro = mysqli_query($con,$id_pro);
                    
                    if($sql_id_pro->num_rows > 0){
                        while($row = mysqli_fetch_array($sql_id_pro)){
                            $array = array($row['id_producto']);
                            
                            $id_producto = $array[0];
                            //DELETE FROM nombre_tabla WHERE nombre_columna = valor
                            $delete_resta_existencia = "DELETE FROM inventarios  where Id_producto='".$id_producto."' and Id_sucursal='".$id_sucursal."'";
                            $sql_delete_resta_existencia = mysqli_query($con,$delete_resta_existencia);

                            echo '
                                    <div class="alert alert-success" role="alert">
                                    El producto a sido dado de abajo
                                    Salga de esta pagina y vuelva a entrar para realizar todos los cambios
                                    </div>
                                    ';
                        }
                    }
            }
        }
        
        $con->close();
    }else{
        echo '
        <div class="alert alert-danger" role="alert">
        El codigo debe contener 5 digitos 
        </div>
        ';
    }
    
}

?>