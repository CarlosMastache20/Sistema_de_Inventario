<?php

function contador($id_sucursal){

    include ('../../DB/db.php');

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    //Verifica la conexion
    if($conn->connect_error){
        die("Error en la conexion: " . $conn->connect_error);
    }else{
        switch ($id_sucursal) {
            case 1:
                $result = $conn->query($contador1);
                break;
                case 2:
                    $result = $conn->query($contador2);
                    break;
                    case 3:
                        $result = $conn->query($contador3);
                        break;
                        case 4:
                            $result = $conn->query($contador4);
                            break;
                            case 5:
                                $result = $conn->query($contador5);
                                break;
        }
        }
        if($result->num_rows > 0){
            while($row=mysqli_fetch_array($result)){
                echo $row['COUNT(origen)'];
            }
        }
        $conn->close();
}


include ('../../model/solicitud.php');
//Funcion para llenar la tabla

function inventario_S(int $Sc){

    include ('../../DB/db.php');
    
    $solicitud_nuevo = new Solicitud();

    //Creacion de la conexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Verifica la conexion
    if($conn->connect_error){
        die("Error en la conexion: " . $conn->connect_error);
    }else{
        switch ($Sc) {
            case 1;
                $result = $conn->query($sql_Soli_Matriz);
            break;
            case 2:
                $result = $conn->query($sql_Soli_Reforma);
            break;
            case 3:
                $result = $conn->query($sql_Soli_Simbolos_Patrios);
                break;
            case 4:
                $result = $conn->query($sql_Soli_Xoxocotlan);
            break;
            case 5:
                $result = $conn->query($sql_Soli_Zimatlan);
            break;
        }
        $status = 0;
        if($result->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($result)){
                $array = array($row["Sucursal"],$row['producto'],$row['cantidad'],$row['origen'],$row['id_producto'],$row['id']);
                
                $solicitud_nuevo->set_Sucursal($array[0]);
                $solicitud_nuevo->set_Nombre($array[1]);
                $solicitud_nuevo->set_Cantidad($array[2]);
                $solicitud_nuevo->set_Id_Sucursal($array[3]);
                $solicitud_nuevo->set_Id_producto($array[4]);

                $i_S = $solicitud_nuevo->get_Id_Sucursal();
                $i_P = $solicitud_nuevo->get_Id_Producto();

                $id_Soli = $array[5];
               
                    $con = mysqli_connect("localhost","root","1234","papeleria");
                    $sql = "SELECT Id_producto, Id_sucursal, existencia FROM 
                    inventarios where Id_producto='".$i_P."' AND Id_sucursal='".$Sc."'";
                    $r_s_a = mysqli_query($con,$sql);
                        if($r_s_a->num_rows > 0){
                             while($row=mysqli_fetch_array($r_s_a)){
                                $array = array($row["existencia"]);
                                if($solicitud_nuevo->get_Cantidad() > $row['existencia']){
                                    /* echo '<tr>';
                                    echo '<td>' . $solicitud_nuevo->get_Sucursal() . '</td>';
                                    echo '<td>'. $solicitud_nuevo->get_Nombre() .'</td>';
                                    echo '<td>' . $solicitud_nuevo->get_Cantidad() . '</td>';
                                    echo '<td><label>'.$row['existencia'].'</label></td>';
                                    echo '
                                    <td>
                                    <form action="" method="post">
                                        <button type="submit" class="btn btn-danger">Aceptar</button>
                                    </form>
                                    </td>';
                                    echo '</tr>'; */
                                }else{
                                    echo '<tr>';
                                    echo '<td>' . $solicitud_nuevo->get_Sucursal() . '</td>';
                                    echo '<td>'. $solicitud_nuevo->get_Nombre() .'</td>';
                                    echo '<td>' . $solicitud_nuevo->get_Cantidad() . '</td>';
                                    echo '<td><label>'.$row['existencia'].'</label></td>';
                                    echo '
                                    <td>
                                    <form action="../../controller/prestamo/generarCodigo.php" method="post">
                                        <input hidden  type="text" value='.$id_Soli.' name="id">
                                        <input hidden  type="text" value="generarCodi" name="accion">
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                    </form>
                                    </td>';
                                    echo '</tr>';
                                }
                            }
                        }
            }
        }
        $conn->close();
    }

}


//Encontrar todas las solicitudes
function inventario_S_T(){

    include ('../../DB/db.php');
    
    $solicitud_nuevo = new Solicitud();

    //Creacion de la conexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Verifica la conexion
    if($conn->connect_error){
        die("Error en la conexion: " . $conn->connect_error);
    }else{
        $result = $conn->query($sql_Soli_Todas);
        if($result->num_rows > 0){
            while($row=mysqli_fetch_array($result)){
                $array = array($row["Sucursal"],$row['producto'],$row['cantidad'],$row['origen'],$row['id_producto'],$row['id']);
                
                $solicitud_nuevo->set_Sucursal($array[0]);
                $solicitud_nuevo->set_Nombre($array[1]);
                $solicitud_nuevo->set_Cantidad($array[2]);
                $solicitud_nuevo->set_Id_Sucursal($array[3]);
                $solicitud_nuevo->set_Id_producto($array[4]);

                $i_S = $solicitud_nuevo->get_Id_Sucursal();
                $i_P = $solicitud_nuevo->get_Id_Producto();

                $id_Soli = $array[5];
               
                    $con = mysqli_connect("localhost","root","1234","papeleria");
                    /* $sql = "SELECT Id_producto, Id_sucursal, existencia, Sucursal FROM 
                    inventarios INNER JOIN sucursales ON sucursales.id_sucursal=inventarios.Id_sucursal
                    where Id_producto='".$i_P."' AND Id_sucursal!='".$i_S."'"; */

                    $sql = "SELECT Id_producto, inventarios.Id_sucursal, existencia, Sucursal  FROM 
                    inventarios INNER JOIN sucursales ON inventarios.Id_sucursal=sucursales.id_sucursal where 
                    Id_producto='".$i_P."' AND inventarios.Id_sucursal!='".$i_S."'";
                    $r_s_a = mysqli_query($con,$sql);
                        if($r_s_a->num_rows > 0){
                             while($row=mysqli_fetch_array($r_s_a)){
                                $array = array($row["Sucursal"]);
                                if($solicitud_nuevo->get_Cantidad() > $row['Sucursal']){
                                    /* echo '<tr>';
                                    echo '<td>' . $solicitud_nuevo->get_Sucursal() . '</td>';
                                    echo '<td>'. $solicitud_nuevo->get_Nombre() .'</td>';
                                    echo '<td>' . $solicitud_nuevo->get_Cantidad() . '</td>';
                                    echo '<td><label>'.$row['existencia'].'</label></td>';
                                    echo '
                                    <td>
                                    <form action="" method="post">
                                        <button type="submit" class="btn btn-danger">Aceptar</button>
                                    </form>
                                    </td>';
                                    echo '</tr>'; */
                                }else{
                                    echo '<tr>';
                                    echo '<td>' . $solicitud_nuevo->get_Sucursal() . '</td>';
                                    echo '<td>'. $solicitud_nuevo->get_Nombre() .'</td>';
                                    echo '<td>' . $solicitud_nuevo->get_Cantidad() . '</td>';
                                    echo '<td><label>'.$row['Sucursal'].'</label></td>';
                                    echo '
                                    <td>
                                    <form action="../../controller/prestamo/generarCodigo.php" method="post">
                                        <input hidden  type="text" value='.$id_Soli.' name="id">
                                        <input hidden  type="text" value="generarCodi1" name="accion">
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                    </form>
                                    </td>';
                                    echo '</tr>';
                                }
                            }
                        }
            }
        }
        $conn->close();
    }

}

?>