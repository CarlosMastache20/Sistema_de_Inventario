<?php


include ('../../model/solicitud.php');
//Funcion para llenar la tabla

function bajas_S(){

    include ('../../DB/db.php');

    $solicitud_nuevo = new Solicitud();
    
    //Creacion de la conexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Verifica la conexion
    if($conn->connect_error){
        die("Error en la conexion: " . $conn->connect_error);
    }else{
        $result = $conn->query($sql_bajas);

        if($result->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($result)){
                $array = array($row["Sucursal"],$row['producto'],$row['detalles'],$row['origen'],$row['id_producto'],$row['id']);
                
                $solicitud_nuevo->set_Sucursal($array[0]);
                $solicitud_nuevo->set_Nombre($array[1]);
                $solicitud_nuevo->set_Detalles($array[2]);
                $solicitud_nuevo->set_Id_Sucursal($array[3]);
                $solicitud_nuevo->set_Id_producto($array[4]);

                $i_S = $solicitud_nuevo->get_Id_Sucursal();
                $i_P = $solicitud_nuevo->get_Id_Producto();

                $id_Soli = $array[5];
               
                                    echo '<tr>';
                                    echo '<td>' . $solicitud_nuevo->get_Sucursal() . '</td>';
                                    echo '<td>'. $solicitud_nuevo->get_Nombre() .'</td>';
                                    echo '<td>' . $solicitud_nuevo->get_Detalles() . '</td>';
                                    echo '<td><form action="../../controller/baja_alta/generarCodigo.php" method="post">
                                    <textarea name="detalles" id="" cols="35" rows="3"></textarea></td>';
                                    echo '
                                    <td>
                                        <input hidden  type="text" value='.$id_Soli.' name="id">
                                        <input hidden  type="text" value="generarCodi" name="accion">
                                        <button type="submit" class="btn btn-danger">Dar de baja</button>
                                    </form>
                                    </td>';
                                    echo '</tr>';
            }
        }

        $conn->close();
    }

}


//Contador de bajas
function contador_bajas(){

    include ('../../DB/db.php');

    
    //Creacion de la conexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Verifica la conexion
    if($conn->connect_error){
        die("Error en la conexion: " . $conn->connect_error);
    }else{

        $result = $conn->query($sql_contador_bajas);

        if($result->num_rows > 0){

            while($row=mysqli_fetch_array($result)){
                $array = array($row["COUNT(id)"]);
                 if($row["COUNT(id)"] > 0){
                    echo '
                    <br>
                    <div class="alert alert-danger text-center" role="alert">
                        Tiene solicitud(es) de bajas de productos 
                    </div>
                    ';
                 }else{
                    echo '
                    <br>
                    <div class="alert alert-info text-center" role="alert">
                        No tienen solicitudes de bajas
                    </div>
                    ';
                 }
               
            }
        }

        $conn->close();
    }

}

?>