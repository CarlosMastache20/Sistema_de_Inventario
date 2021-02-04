<?php
include ('../../model/solicitud.php');



include ('../../DB/db.php');
    
    //Creacion del modelo
    $solicitud_nuevo = new Solicitud();

    //Creacion de la conexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Verifica la conexion
    if($conn->connect_error){
        die("Error en la conexion: " . $conn->connect_error);
    }else{
        $solicitud_nuevo->set_Nombre(($_POST['nombre']));
        $solicitud_nuevo->set_Cantidad(($_POST['cantidad']));
        $solicitud_nuevo->set_Id_Sucursal(($_POST['id_sucursal']));

        $nombre = $solicitud_nuevo->get_Nombre();
        $cantidad = $solicitud_nuevo->get_Cantidad();
        $id_sucursal = $solicitud_nuevo->get_Id_Sucursal();
        
        $con = mysqli_connect("localhost","root","1234","papeleria");
        $con->set_charset("utf8");
        $consulta = "INSERT INTO solicitudes(id,origen, producto, cantidad, estado, codigo)
        values (null,'".$id_sucursal."','".$nombre."','".$cantidad."',0,0)";
        $soli = mysqli_query($con,$consulta);
        $conn->close();
        header('location: ../../view/director_departamental/home.php');
        
    }


?>