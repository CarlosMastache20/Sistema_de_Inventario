<?php


include ('../../model/usuario.php');

//Función para valores de texto permitidos
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function registro(string $user, string $pwd, string $pwdC, string $email){
    include ('../../DB/db.php');

    $name = $pass = $correo = $pass_confirm = "";
    $nameC = $passC = $correoC = $passCC = 0;
    
    $usuario_nuevo = new Usuario();

    $usuario_nuevo->set_Usuario(test_input($user));
    $usuario_nuevo->set_Contrasenia(test_input($pwd));
    $usuario_nuevo->set_ContraseniaC(test_input($pwdC));
    $usuario_nuevo->set_Correo(test_input($email));

    // Creacion de la conexion 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexion 
    if ($conn->connect_error) { die("Error en la conexion: " . $conn->connect_error);}
    else{
        if (empty($usuario_nuevo->get_Usuario())) {
            echo '
      <br><br>
      <div class="alert alert-danger" role="alert">
       Falta el nombre
      </div>
      ';
          } else {
            $name = $usuario_nuevo->get_Usuario();
            // Checa que solamente tenga letras y espacios
            
              $nameC = 1;
          }
        
          if (empty($usuario_nuevo->get_Contrasenia())){
            echo '
            <br><br>
            <div class="alert alert-danger" role="alert">
              Falta contraseña
            </div>
            ';
          }else{
            $pass = $usuario_nuevo->get_Contrasenia();
            $passC = 1;
          }
        
          if (empty($usuario_nuevo->get_ContraseniaC())){
            echo '
            <br><br>
            <div class="alert alert-danger" role="alert">
              Falta contraseña
            </div>
            ';
          }else{
            $pass_confirm = $usuario_nuevo->get_ContraseniaC();
            $passCC = 1;
          }
        
          if (empty($usuario_nuevo->get_Correo())) {
            echo '
            <br><br>
            <div class="alert alert-danger" role="alert">
            Falta correo
            </div>
            ';
          } else {
            $correo = $usuario_nuevo->get_Correo();
            // check if e-mail address is well-formed
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                echo '
                <br><br>
                <div class="alert alert-danger" role="alert">
                 Formato invalido
                </div>
                ';
            }else{
              $correoC = 1;
            }
          }
        
          if($passC == 1 AND $passCC == 1){
            if($pass == $pass_confirm){
              //Usuario o correo repetido
              if($nameC == 1 AND $correoC == 1){
                // Creacion de la conexion 
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Verifica la conexion 
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT usuario FROM personas WHERE usuario = '".$name."'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo '
                    <br><br>
                    <div class="alert alert-danger" role="alert">
                      Usuario existente
                    </div>
                    ';
                }
                else {
                  $sql1 = "SELECT correo FROM personas WHERE correo = '".$correo."'";
                  $result1 = $conn->query($sql1);
                  if ($result1->num_rows > 0) {
                    echo '
                    <br><br>
                    <div class="alert alert-danger" role="alert">
                        Correo existente
                    </div>
                    ';
                  }else{
                    $sql2 = "INSERT INTO personas (usuario, contrasenia, correo)
                    VALUES ('".$name."' , '".$pass."', '".$correo."')";
        
                    if (mysqli_query($conn, $sql2)) {
                        echo '
                        <br><br>
                        <div class="alert alert-success" role="alert">
                          Su usuario a sido creado
                        </div>
                        ';
                      $name = "";
                      $pass = "";
                      $pass_confirm = "";
                      $correo = "";
                    } else {
                      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                  }
                }
              }
            }else{
                echo '
                <br><br>
                <div class="alert alert-danger" role="alert">
                  Las contraseñas no son iguales
                </div>
                ';
              $pass = "";
              $pass_confirm = "";
            }
          }        
    $conn->close();
    }
}

?>