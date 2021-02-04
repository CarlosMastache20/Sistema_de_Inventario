<?php

include ('../../model/reportes.php');

function obtener_fechasG(){
    include ('../../DB/db.php');

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
    $con = mysqli_connect("localhost","root","1234","papeleria");
    $sql = "SELECT DISTINCT year(fecha) from ventas  GROUP by fecha ";
    $r_s_a = mysqli_query($con,$sql);
    $status = 0;
        if($r_s_a->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($r_s_a)){
               echo '<option value=';
               echo $row['year(fecha)'];
               echo '>';
               echo $row['year(fecha)'];
               echo '</option>';
            }
        }
    $conn->close();
    }
}

function reportesG_Anual(string $year){

    include ('../../DB/db.php');

    $reporte_nuevo = new Reportes();

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
    $con = mysqli_connect("localhost","root","1234","papeleria");
    $sql = "SELECT ventas.id_producto, nombre, SUM(cantidad), SUM(ventas.precio) 
    from ventas inner join productos ON ventas.id_producto=productos.id_producto where year(fecha)='$year' GROUP by id_producto";
    $r_s_a = mysqli_query($con,$sql);
    $status = 0;
        if($r_s_a->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($r_s_a)){
                $array = array($row["nombre"],$row['SUM(cantidad)'],$row['SUM(ventas.precio)']);
                
                $reporte_nuevo->set_Categoria($array[0]);
                $reporte_nuevo->set_Cantidad($array[1]);
                $reporte_nuevo->set_Precio($array[2]);

                echo '<tr>';
                echo '<td>' . $reporte_nuevo->get_Categoria() . '</td>';
                echo '<td>'. $reporte_nuevo->get_Cantidad() .'</td>';
                echo '<td> $' . $reporte_nuevo->get_Precio() . '</td>'; 
                echo '</tr>';
            }
        }
    $conn->close();
    }

}


function SumaG_C_V(string $year){
    include ('../../DB/db.php');

    $reporte_nuevo = new Reportes();

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
    $con = mysqli_connect("localhost","root","1234","papeleria");
    $sql = "SELECT SUM(cantidad), SUM(ventas.precio), fecha 
    from ventas inner join productos ON ventas.id_producto=productos.id_producto where year(fecha)='$year'";
    $r_s_a = mysqli_query($con,$sql);
    $status = 0;
        if($r_s_a->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($r_s_a)){
                $array = array($row["SUM(cantidad)"],$row['SUM(ventas.precio)']);
                echo '
                <h5>Total de Productos <span class="badge bg-secondary">'.$row["SUM(cantidad)"].'</span></h5>
                <h5>Ventas Totales <span class="badge bg-secondary"> $'.$row["SUM(ventas.precio)"].'</span></h5>
                ';

                
            }
        }
    $conn->close();
    }
}


//Trimestre
function SumaGT_C_V(string $year, string $trimestre){
    include ('../../DB/db.php');

    $reporte_nuevo = new Reportes();

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
    $con = mysqli_connect("localhost","root","1234","papeleria");
    switch ($trimestre) {
        case 'T1':
            $sql = "SELECT SUM(cantidad), SUM(ventas.precio), fecha 
            from ventas inner join productos ON ventas.id_producto=productos.id_producto where year(fecha)='$year' 
            and month(fecha)>=1 and month(fecha)<=3";
            break;

        case 'T2':
            $sql = "SELECT SUM(cantidad), SUM(ventas.precio), fecha 
            from ventas inner join productos ON ventas.id_producto=productos.id_producto where year(fecha)='$year' and 
            month(fecha)>=4 and month(fecha)<=6";
            break;
        case 'T3':
            $sql = "SELECT SUM(cantidad), SUM(ventas.precio), fecha 
            from ventas inner join productos ON ventas.id_producto=productos.id_producto where year(fecha)='$year' and 
            month(fecha)>=7 and month(fecha)<=9";
            break;
        case 'T4':
            $sql = "SELECT SUM(cantidad), SUM(ventas.precio), fecha 
            from ventas inner join productos ON ventas.id_producto=productos.id_producto where year(fecha)='$year' and 
            month(fecha)>=10 and month(fecha)<=12";
            break;
    }
    $r_s_a = mysqli_query($con,$sql);
    $status = 0;
        if($r_s_a->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($r_s_a)){
                $array = array($row["SUM(cantidad)"],$row['SUM(ventas.precio)']);
                echo '
                <h5>Total de Productos <span class="badge bg-secondary">'.$row["SUM(cantidad)"].'</span></h5>
                <h5>Ventas Totales <span class="badge bg-secondary"> $'.$row["SUM(ventas.precio)"].'</span></h5>
                ';

                
            }
        }
    $conn->close();
    }
}


function reportesG_Trimestral(string $year,string $trimestre){

    include ('../../DB/db.php');

    $reporte_nuevo = new Reportes();

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
    $con = mysqli_connect("localhost","root","1234","papeleria");
    switch ($trimestre) {
        case 'T1':
            $sql = "SELECT ventas.id_producto, nombre, SUM(cantidad), SUM(ventas.precio) 
            from ventas inner join productos ON ventas.id_producto=productos.id_producto where year(fecha)='$year' and month(fecha)>=1 AND month(fecha)<=3 GROUP by id_producto";
            break;
        case 'T2':
            $sql = "SELECT ventas.id_producto, nombre, SUM(cantidad), SUM(ventas.precio) 
            from ventas inner join productos ON ventas.id_producto=productos.id_producto where year(fecha)='$year' and month(fecha)>=4 AND month(fecha)<=6 GROUP by id_producto";
            break;
        case 'T3':
            $sql = "SELECT ventas.id_producto, nombre, SUM(cantidad), SUM(ventas.precio) 
            from ventas inner join productos ON ventas.id_producto=productos.id_producto where year(fecha)='$year' and month(fecha)>=7 AND month(fecha)<=9 GROUP by id_producto";
            break;
        case 'T4':
            $sql = "SELECT ventas.id_producto, nombre, SUM(cantidad), SUM(ventas.precio) 
            from ventas inner join productos ON ventas.id_producto=productos.id_producto where year(fecha)='$year' and month(fecha)>=10 AND month(fecha)<=12 GROUP by id_producto";
            break;
    }
    $r_s_a = mysqli_query($con,$sql);
    $status = 0;
        if($r_s_a->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($r_s_a)){
                $array = array($row["nombre"],$row['SUM(cantidad)'],$row['SUM(ventas.precio)']);
                
                $reporte_nuevo->set_Categoria($array[0]);
                $reporte_nuevo->set_Cantidad($array[1]);
                $reporte_nuevo->set_Precio($array[2]);

                echo '<tr>';
                echo '<td>' . $reporte_nuevo->get_Categoria() . '</td>';
                echo '<td>'. $reporte_nuevo->get_Cantidad() .'</td>';
                echo '<td> $' . $reporte_nuevo->get_Precio() . '</td>'; 
                echo '</tr>';
            }
        }
    $conn->close();
    }

}


//Mensual
function SumaGM_C_V(string $year,string $mes){
    include ('../../DB/db.php');

    $reporte_nuevo = new Reportes();
    $Nm=0;
    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
    $con = mysqli_connect("localhost","root","1234","papeleria");
    switch ($mes) {
        case 'Enero':
            $Nm=1;
            break;
        case 'Febrero':
            $Nm=2;
            break;
        case 'Marzo':
            $Nm=3;
            break;
        case 'Abril':
            $Nm=4;
            break;
        case 'Mayo':
            $Nm=5;
            break;
        case 'Junio':
            $Nm=6;
            break;
        case 'Julio':
            $Nm=7;
            break;
        case 'Agosto':
            $Nm=8;
            break;
        case 'Septiembre':
            $Nm=9;
            break;
        case 'Octubre':
            $Nm=10;
            break;
        case 'Noviembre':
            $Nm=11;
            break;
        case 'Diciembre':
            $Nm=12;
            break;
    }
    $sql = "SELECT SUM(cantidad), SUM(ventas.precio), fecha 
    from ventas inner join productos ON ventas.id_producto=productos.id_producto where year(fecha)='$year' 
    and month(fecha)='$Nm'";
    $r_s_a = mysqli_query($con,$sql);
    $status = 0;
        if($r_s_a->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($r_s_a)){
                $array = array($row["SUM(cantidad)"],$row['SUM(ventas.precio)']);
                echo '
                <h5>Total de Productos <span class="badge bg-secondary">'.$row["SUM(cantidad)"].'</span></h5>
                <h5>Ventas Totales <span class="badge bg-secondary"> $'.$row["SUM(ventas.precio)"].'</span></h5>
                ';

                
            }
        }
    $conn->close();
    }
}


function reportesG_Mensual(string $year,string $mes){

    include ('../../DB/db.php');

    $reporte_nuevo = new Reportes();

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
    $con = mysqli_connect("localhost","root","1234","papeleria");
    switch ($mes) {
        case 'Enero':
            $Nm=1;
            break;
        case 'Febrero':
            $Nm=2;
            break;
        case 'Marzo':
            $Nm=3;
            break;
        case 'Abril':
            $Nm=4;
            break;
        case 'Mayo':
            $Nm=5;
            break;
        case 'Junio':
            $Nm=6;
            break;
        case 'Julio':
            $Nm=7;
            break;
        case 'Agosto':
            $Nm=8;
            break;
        case 'Septiembre':
            $Nm=9;
            break;
        case 'Octubre':
            $Nm=10;
            break;
        case 'Noviembre':
            $Nm=11;
            break;
        case 'Diciembre':
            $Nm=12;
            break;
    }
            $sql = "SELECT ventas.id_producto, nombre, SUM(cantidad), SUM(ventas.precio) 
            from ventas inner join productos ON ventas.id_producto=productos.id_producto where year(fecha)='$year' 
            and month(fecha)='$Nm'
            GROUP by id_producto";
    $r_s_a = mysqli_query($con,$sql);
    $status = 0;
        if($r_s_a->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($r_s_a)){
                $array = array($row["nombre"],$row['SUM(cantidad)'],$row['SUM(ventas.precio)']);
                
                $reporte_nuevo->set_Categoria($array[0]);
                $reporte_nuevo->set_Cantidad($array[1]);
                $reporte_nuevo->set_Precio($array[2]);

                echo '<tr>';
                echo '<td>' . $reporte_nuevo->get_Categoria() . '</td>';
                echo '<td>'. $reporte_nuevo->get_Cantidad() .'</td>';
                echo '<td> $' . $reporte_nuevo->get_Precio() . '</td>'; 
                echo '</tr>';
            }
        }
    $conn->close();
    }

}


?>