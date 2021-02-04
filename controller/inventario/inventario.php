<?php

include ('../../model/productos.php');
//Funcion para llenar la tabla

function inventario(int $Sc){

    include ('../../DB/db.php');
    
    $inventario_nuevo = new Producto();

    //Creacion de la conexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Verifica la conexion
    if($conn->connect_error){
        die("Error en la conexion: " . $conn->connect_error);
    }else{
        switch ($Sc) {
            case 1;
                $result = $conn->query($sql_inventario_Matriz);
            break;
            case 2:
                $result = $conn->query($sql_inventario_Reforma);
            break;
            case 3:
                $result = $conn->query($sql_inventario_Simbolos_Patrios);
                break;
            case 4:
                $result = $conn->query($sql_inventario_Xoxocotlan);
            break;
            case 5:
                $result = $conn->query($sql_inventario_Zimatlan);
            break;
        }
        $status = 0;
        if($result->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($result)){
                $array = array($row["nombre"],$row['marca'],$row['existencia'],$row['precio'],$row['categoria']);
                
                $inventario_nuevo->set_Nombre($array[0]);
                $inventario_nuevo->set_Marca($array[1]);
                $inventario_nuevo->set_Existencia($array[2]);
                $inventario_nuevo->set_Precio($array[3]);
                $inventario_nuevo->set_Categoria($array[4]);

                echo '<tr>';
                echo '<td>' . $inventario_nuevo->get_Nombre() . '</td>';
                echo '<td>'. $inventario_nuevo->get_Marca() .'</td>';
                echo '<td>' . $inventario_nuevo->get_Existencia() . '</td>'; 
                echo '<td> $' . $inventario_nuevo->get_Precio() . '</td>';
                echo '<td>' . $inventario_nuevo->get_Categoria() . '</td>';
                echo '</tr>';
            }
        }
        $conn->close();
    }

    if($status==0){
        echo '
        <br>
        <div class="alert alert-danger text-center" role="alert">
           Sucursal vacía
        </div>
        ';
    }
}


function inventario_Confirmar(int $Sc){

    include ('../../DB/db.php');
    
    $inventario_nuevo = new Producto();

    //Creacion de la conexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Verifica la conexion
    if($conn->connect_error){
        die("Error en la conexion: " . $conn->connect_error);
    }else{
        switch ($Sc) {
            case 1;
                $result = $conn->query($sql_inventario_Matriz);
            break;
            case 2:
                $result = $conn->query($sql_inventario_Reforma);
            break;
            case 3:
                $result = $conn->query($sql_inventario_Simbolos_Patrios);
                break;
            case 4:
                $result = $conn->query($sql_inventario_Xoxocotlan);
            break;
        }
        $status = 0;
        if($result->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($result)){
                $array = array($row["nombre"],$row['marca'],$row['existencia'],$row['id_inventario']);
                
                $inventario_nuevo->set_Nombre($array[0]);
                $inventario_nuevo->set_Marca($array[1]);
                $inventario_nuevo->set_Existencia($array[2]);
                $inventario_nuevo->set_Id_inventario($array[3]);

                echo '<tr>';
                echo '<td>' . $inventario_nuevo->get_Nombre() . '</td>';
                echo '<td>'. $inventario_nuevo->get_Marca() .'</td>';
                echo '<td>' . $inventario_nuevo->get_Existencia() . '</td>';
                echo '<form action="../../controller/prestamo/ProcesoPres.php" method="POST">';
                echo '<td>';
                echo '<select name="sucursal" id="">
                        <option value="Matriz">Matriz</option>
                        <option value="Reforma">Reforma</option>
                        <option value="Simbolos Patrios">Simbolos Patrios</option>
                        <option value="Xoxocotlan">Xoxocotlan</option>
                        <option value="Zimatlan">Zimatlan</option>
                    </select>';
                echo '</td>'; 
                echo '<td>';
                echo '<label>Unidades a prestar</label>';
                echo '<input type="number" name="N_P">';
                echo '<input type="hidden" value='.$inventario_nuevo->get_Id_inventario().' name="id_inventario">';
                echo '<button type="sumbit" name="" id="" class="btn btn-info">Enviar</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
        }
        $conn->close();
    }

    if($status==0){
        echo '
        <br>
        <div class="alert alert-danger text-center" role="alert">
           Sucursal vacía
        </div>
        ';
    }
}


function productos_sucursal(int $Sc){
    include ('../../DB/db.php');
    
    $inventario_nuevo = new Producto();

    //Creacion de la conexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Verifica la conexion
    if($conn->connect_error){
        die("Error en la conexion: " . $conn->connect_error);
    }else{
        switch ($Sc) {
            case 1;
                $result = $conn->query($sql_inventario_Matriz);
            break;
            case 2:
                $result = $conn->query($sql_inventario_Reforma);
            break;
            case 3:
                $result = $conn->query($sql_inventario_Simbolos_Patrios);
                break;
            case 4:
                $result = $conn->query($sql_inventario_Xoxocotlan);
            break;
        }
        $status = 0;
        if($result->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($result)){
                $array = array($row["nombre"]);
                
                $inventario_nuevo->set_Nombre($array[0]);

                echo '<option value='. $inventario_nuevo->get_Nombre() .'>'.  $inventario_nuevo->get_Nombre(). '</option>';

            }
        }
        $conn->close();
    }

    if($status==0){
        echo '';

    }
}


//Inventario para el director general
function inventario_departamento_General(int $Sc){

    include ('../../DB/db.php');
    
    $inventario_nuevo = new Producto();

    //Creacion de la conexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Verifica la conexion
    if($conn->connect_error){
        die("Error en la conexion: " . $conn->connect_error);
    }else{
        switch ($Sc) {
            case 1;
                $result = $conn->query($sql_inventario_Matriz);
            break;
            case 2:
                $result = $conn->query($sql_inventario_Reforma);
            break;
            case 3:
                $result = $conn->query($sql_inventario_Simbolos_Patrios);
                break;
            case 4:
                $result = $conn->query($sql_inventario_Xoxocotlan);
            break;
            case 5:
                $result = $conn->query($sql_inventario_Zimatlan);
            break;
            case 6:
                $result = $conn->query($sql_inventario_General);
            break;
        }
        $status = 0;
        if($result->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($result)){
                $array = array($row["nombre"],$row['marca'],$row['existencia'],$row['precio']);
                
                $inventario_nuevo->set_Nombre($array[0]);
                $inventario_nuevo->set_Marca($array[1]);
                $inventario_nuevo->set_Existencia($array[2]);
                $inventario_nuevo->set_Precio($array[3]);

                echo '<tr>';
                echo '<td>' . $inventario_nuevo->get_Nombre() . '</td>';
                echo '<td>'. $inventario_nuevo->get_Marca() .'</td>';
                echo '<td>' . $inventario_nuevo->get_Existencia() . '</td>'; 
                echo '<td> $' . $inventario_nuevo->get_Precio() . '</td>';
                echo '</tr>';
            }
        }
        $conn->close();
    }

    if($status==0){
        echo '
        <br>
        <div class="alert alert-danger text-center" role="alert">
           Sucursal vacía
        </div>
        ';
    }
}

?>