<?php

include ('../../model/reportes.php');

function reportes_SUB_Anual(string $year,string $id_sucursal){

    include ('../../DB/db.php');

    $reporte_nuevo = new Reportes();

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
    $con = mysqli_connect("localhost","root","1234","papeleria");
    $sql = "SELECT categoria, SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
    INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal' GROUP BY categoria";
    $r_s_a = mysqli_query($con,$sql);
    $status = 0;
        if($r_s_a->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($r_s_a)){
                $array = array($row["categoria"],$row['SUM(cantidad)'],$row['SUM(ventas.precio)']);
                
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


function Suma_C_V(string $year, string $id_sucursal){
    include ('../../DB/db.php');

    $reporte_nuevo = new Reportes();

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
    $con = mysqli_connect("localhost","root","1234","papeleria");
    $sql = "SELECT SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
    INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal'";
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


function obtener_fechas($id_sucursal){
    include ('../../DB/db.php');

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
    $con = mysqli_connect("localhost","root","1234","papeleria");
    $sql = "SELECT DISTINCT year(fecha) from ventas where id_sucursal='$id_sucursal' GROUP by fecha ";
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

//Trimestre
function SumaT_C_V(string $year, string $id_sucursal, string $trimestre){
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
            $sql = "SELECT SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal'
            AND month(fecha)>=1 AND month(fecha)<=3";
            break;

        case 'T2':
            $sql = "SELECT SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal'
            AND month(fecha)>=4 AND month(fecha)<=6";
            break;
        case 'T3':
            $sql = "SELECT SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal'
                AND month(fecha)>=7 AND month(fecha)<=9";
            break;
        case 'T4':
            $sql = "SELECT SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal'
                AND month(fecha)>=10 AND month(fecha)<=12";
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


function reportes_SUB_Trimestral(string $year,string $id_sucursal, string $trimestre){

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
            $sql = "SELECT categoria, SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND
            month(fecha)>=1 AND month(fecha)<=3  AND id_sucursal='$id_sucursal'
            GROUP BY categoria";
            break;
        case 'T2':
            $sql = "SELECT categoria, SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND
            month(fecha)>=4 AND month(fecha)<=6  AND id_sucursal='$id_sucursal'
            GROUP BY categoria";
            break;
        case 'T3':
            $sql = "SELECT categoria, SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND
            month(fecha)>=7 AND month(fecha)<=9  AND id_sucursal='$id_sucursal'
            GROUP BY categoria";
            break;
        case 'T4':
            $sql = "SELECT categoria, SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND
            month(fecha)>=10 AND month(fecha)<=12  AND id_sucursal='$id_sucursal'
            GROUP BY categoria";
            break;
    }
    $r_s_a = mysqli_query($con,$sql);
    $status = 0;
        if($r_s_a->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($r_s_a)){
                $array = array($row["categoria"],$row['SUM(cantidad)'],$row['SUM(ventas.precio)']);
                
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
function SumaM_C_V(string $year, string $id_sucursal, string $mes){
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
    $sql = "SELECT SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal'
            AND month(fecha)='$Nm'";
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


function reportes_SUB_Mensual(string $year,string $id_sucursal, string $mes){

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
            $sql = "SELECT categoria, SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND
            month(fecha)='$Nm'  AND id_sucursal='$id_sucursal'
            GROUP BY categoria";
    $r_s_a = mysqli_query($con,$sql);
    $status = 0;
        if($r_s_a->num_rows > 0){
            $status=true;
            while($row=mysqli_fetch_array($r_s_a)){
                $array = array($row["categoria"],$row['SUM(cantidad)'],$row['SUM(ventas.precio)']);
                
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


/*Reportes por SUB categoria */
function reportesCa_SUB_Anual(string $year,string $id_sucursal, string $categoria){

    include ('../../DB/db.php');

    $reporte_nuevo = new Reportes();

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
    $con = mysqli_connect("localhost","root","1234","papeleria");
    $sql = "SELECT categoria,  nombre, SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
    INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal' AND categoria = '$categoria' GROUP BY nombre";
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


function SumaCa_C_V(string $year, string $id_sucursal, string $categoria){
    include ('../../DB/db.php');

    $reporte_nuevo = new Reportes();

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
    $con = mysqli_connect("localhost","root","1234","papeleria");
    $sql = "SELECT SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
    INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal' and categoria='$categoria'";
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
function SumaTCa_C_V(string $year, string $id_sucursal, string $trimestre, string $categoria){
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
            $sql = "SELECT SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal'
            AND month(fecha)>=1 AND month(fecha)<=3 and categoria='$categoria'";
            break;

        case 'T2':
            $sql = "SELECT SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal'
            AND month(fecha)>=4 AND month(fecha)<=6 and categoria='$categoria'";
            break;
        case 'T3':
            $sql = "SELECT SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal'
                AND month(fecha)>=7 AND month(fecha)<=9 and categoria='$categoria'";
            break;
        case 'T4':
            $sql = "SELECT SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal'
                AND month(fecha)>=10 AND month(fecha)<=12 and categoria='$categoria'";
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


function reportesCa_SUB_Trimestral(string $year,string $id_sucursal, string $trimestre, string $categoria){

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
            $sql = "SELECT nombre, categoria, SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND
            month(fecha)>=1 AND month(fecha)<=3  AND id_sucursal='$id_sucursal' and categoria='$categoria'
            GROUP BY nombre";
            break;
        case 'T2':
            $sql = "SELECT nombre, categoria, SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND
            month(fecha)>=4 AND month(fecha)<=6  AND id_sucursal='$id_sucursal' and categoria='$categoria'
            GROUP BY nombre";
            break;
        case 'T3':
            $sql = "SELECT nombre, categoria, SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND
            month(fecha)>=7 AND month(fecha)<=9  AND id_sucursal='$id_sucursal' and categoria='$categoria'
            GROUP BY nombre";
            break;
        case 'T4':
            $sql = "SELECT nombre, categoria, SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND
            month(fecha)>=10 AND month(fecha)<=12  AND id_sucursal='$id_sucursal' and categoria='$categoria'
            GROUP BY nombre";
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
function SumaMCa_C_V(string $year, string $id_sucursal, string $mes, string $categoria){
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
    $sql = "SELECT SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND id_sucursal='$id_sucursal'
            AND month(fecha)='$Nm' and categoria='$categoria'";
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


function reportesCa_SUB_Mensual(string $year,string $id_sucursal, string $mes, string $categoria){

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
            $sql = "SELECT nombre, categoria, SUM(cantidad), SUM(ventas.precio),id_sucursal from ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto 
            INNER JOIN categorias ON productos.id_clasificacion=categorias.id_categoria where year(fecha)='$year'AND
            month(fecha)='$Nm'  AND id_sucursal='$id_sucursal' and categoria='$categoria'
            GROUP BY nombre";
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
