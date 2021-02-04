<?php

include ('../../model/solicitud.php');

function msg_codigo(int $Sc){
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
                $result = $conn->query($sql_Obtener_codigo_Matriz);
            break;
            case 2:
                $result = $conn->query($sql_Obtener_codigo_Reforma);
            break;
            case 3:
                $result = $conn->query($sql_Obtener_codigo_Simbolos_Patrios);
                break;
            case 4:
                $result = $conn->query($sql_Obtener_codigo_Xoxocotlan);
            break;
            case 5:
                $result = $conn->query($sql_Obtener_codigo_Zimatlan);
            break;
        }
        if($result->num_rows > 0){
            while($row=mysqli_fetch_array($result)){
                $array = array($row["producto"],$row['cantidad'],$row['codigo']);
                $solicitud_nuevo->set_Nombre($array[0]);
                $solicitud_nuevo->set_Cantidad($array[1]);
                $solicitud_nuevo->set_Codigo_prestamo($array[2]);

                echo '
                <div class="col-lg-4">
                    <button type="button" class="btn btn-light">
                    Nuevo Código <span class="badge bg-secondary">'.$solicitud_nuevo->get_Codigo_prestamo().'</span>
                    para '.$solicitud_nuevo->get_Cantidad().' '.$solicitud_nuevo->get_Nombre().'  
                    </button>
                </div>
                ';

            }
        }
        $conn->close();
    }
}


function confirmar_codigo_actualizar(string $codigo, int $id_sucursal){

    if(strlen($codigo) >= 1){
        //Primero actualiza la tabla para quitar el mensaje
        $con = mysqli_connect("localhost","root","1234","papeleria");
        $con->set_charset("utf8");
        $consulta = "UPDATE solicitudes SET estado=2 WHERE codigo = '".$codigo."'";
        $soli = mysqli_query($con,$consulta);

        //Obtengo el producto y la cantidad para actualizar la base de datos
        $pro_cant = "SELECT producto,cantidad from solicitudes WHERE codigo = '".$codigo."'";
        $sql_pro_cant = mysqli_query($con,$pro_cant);

        if($sql_pro_cant->num_rows > 0){
            while($row = mysqli_fetch_array($sql_pro_cant)){
                $array = array($row['producto'],$row['cantidad']);

                $producto = $array[0];
                $cantidad = $array[1];

                //Obtener el id de ese producto
                    $id_pro = "SELECT id_producto, nombre FROM productos where nombre = '".$producto."'";
                    $sql_id_pro = mysqli_query($con,$id_pro);
                    
                    if($sql_id_pro->num_rows > 0){
                        while($row = mysqli_fetch_array($sql_id_pro)){
                            $array = array($row['id_producto']);
                            
                            $id_producto = $array[0];


                            $update_resta_existencia = "UPDATE inventarios SET existencia = existencia + $cantidad where Id_producto='".$id_producto."' and Id_sucursal='".$id_sucursal."'";
                            $sql_update_resta_existencia = mysqli_query($con,$update_resta_existencia);
                            
                            $existencia_actual = "SELECT existencia from inventarios WHERE Id_producto='".$id_producto."' and Id_sucursal='".$id_sucursal."'";
                            $sql_existencia_actual = mysqli_query($con,$existencia_actual);
                            if($sql_existencia_actual->num_rows > 0){
                                while($row = mysqli_fetch_array($sql_existencia_actual)){
                                    $array = array($row['existencia']);
                                    
                                    $existencia = $array[0];

                                    echo '
                                    <div class="alert alert-success" role="alert">
                                    El producto '.$producto.' ha sido actulizado, con '.$cantidad.' ahora tiene '.$existencia.'
                                    Salga de esta pagina y vuelva a entrar para realizar todos los cambios
                                    </div>
                                    ';
                                }
                            }
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