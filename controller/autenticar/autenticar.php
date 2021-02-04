<?php

include ('../../model/usuario.php');

//Función para valores de texto permitidos
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function autenticacion(string $user,string $pwd){

    include ('../../DB/db.php');

    $id_puesto = 0;
    $id_sucursal = 0;

    $usuario_nuevo = new Usuario();

    $usuario_nuevo->set_Usuario(test_input($user));
    $usuario_nuevo->set_Contrasenia(test_input($pwd));

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
      $result = $conn->query($sql_autenticar);
      $status = 0;
      $UserNA = 0;
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          if($usuario_nuevo->get_Usuario() == $row[$campo01_user] &&
            $usuario_nuevo->get_Contrasenia() == $row[$campo02_pwd]){
              $status = true;
              $usuario_nuevo->set_Puesto($row['id_puesto']);
              $usuario_nuevo->set_Sucursal($row['id_sucursal']);
              if($usuario_nuevo->get_Puesto()==NULL and $usuario_nuevo->get_Sucursal()==NULL){
                  $UserNA=1;
              }else{
                  $UserNA=2;
              }
            }
        }
      }
    $conn->close();
    }
    if($status==0){
        echo '
        <br>
        <div class="alert alert-danger text-center" role="alert">
            Datos incorrectos
        </div>
        ';
    }
    if($status==1 and $UserNA==2){
        $_SESSION['login'] = $usuario_nuevo->get_Usuario();
        $_SESSION['username'] = $usuario_nuevo->get_Usuario();
        $_SESSION['id_sucursal'] = $usuario_nuevo->get_Sucursal();
        switch ($usuario_nuevo->get_Puesto()) {
            case 1:
                header('location: ../../view/administrador/home.php');
                break;
            case 2:
                header('location: ../../view/director_general/home.php');
                break;
            case 3:
                header('location: ../../view/director_departamental/home.php');
                break;
            case 4:
                header('location: ../../view/colaborador/home.php');
                break;
        }
    }
    else{
        echo '
                <br>
                <div class="alert alert-info text-center" role="alert">
                    Todavia no lo dan de alta
                </div>
                ';
    }
}

?>