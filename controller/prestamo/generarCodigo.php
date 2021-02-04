<?php
$id = trim($_POST['id']);
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
        $consulta = "UPDATE solicitudes SET codigo = '".$codigo."', estado=1 WHERE id = '".$id."'";
        $soli = mysqli_query($con,$consulta);
        $conn->close();
        header('location: ../../view/director_departamental/solicitudes.php');
        break;
      case 'generarCodi1':
        $con = mysqli_connect("localhost","root","1234","papeleria");
        $con->set_charset("utf8");
        $consulta = "UPDATE solicitudes SET codigo = '".$codigo."', estado=1 WHERE id = '".$id."'";
        $soli = mysqli_query($con,$consulta);
        $conn->close();
        header('location: ../../view/director_general/home.php');
        break;
    }
    $conn->close();
}


?>