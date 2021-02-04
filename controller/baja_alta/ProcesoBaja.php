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
        $solicitud_nuevo->set_Id_Sucursal(($_POST['id_sucursal']));
        $solicitud_nuevo->set_Detalles(($_POST['detalles']));

        $nombre = $solicitud_nuevo->get_Nombre();
        $id_sucursal = $solicitud_nuevo->get_Id_Sucursal();
        $detalles = $solicitud_nuevo->get_Detalles();
        
        $con = mysqli_connect("localhost","root","1234","papeleria");
        $con->set_charset("utf8");
        $consulta = "INSERT INTO bajas(id,origen, producto,estado, codigo, detalles)
        values (null,'".$id_sucursal."','".$nombre."',0,0,'".$detalles."')";
        $soli = mysqli_query($con,$consulta);
        $conn->close();
        header('location: ../../view/director_departamental/home.php');
        
    }


?>