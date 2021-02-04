<?php
$id = trim($_POST['id']);
$detalles_admi = $_POST['detalles'];
$accion = $_POST['accion'];
$codigo = "";

$codigo=$id*13579;


include ('../../DB/db.php');

//Creacion de la conexion
$conn = new mysqli($servername, $username, $password, $dbname);

//Verifica la conexion
if($conn->connect_error){
    die("Error en la conexion: " . $conn->connect_error);
}else{
    switch ($accion) {
      case 'generarCodi':
        $con = mysqli_connect("localhost","root","1234","papeleria");
        $con->set_charset("utf8");
        $consulta = "UPDATE bajas SET codigo = '".$codigo."', detalles_admi = '".$detalles_admi."', estado=1 WHERE id = '".$id."'";
        $soli = mysqli_query($con,$consulta);
        $conn->close();
        header('location: ../../view/administrador/baja.php');
        break;
    }
    $conn->close();
}


?>