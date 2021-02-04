<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<?php
include ('../../controller/autenticar/registro.php');
?>
<body class="l-img1">
    <div class="container">
        <div class="row">
            <div class="col lg-4"></div>
            <div class="col lg-4">
                <div class="card text-center l-card1">
                    <div class="card-body">
                        <p class="card-text">
                            <h4 class="l-ico1"><i class="fas fa-user"></i></h4>
                            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                <input type="text" class="form-control l-inp1" id="" required placeholder="Usuario" name="inp_user">
                                <br>
                                <input type="password" class="form-control l-inp1" id="" required placeholder="Contraseña" name="inp_pwd">
                                <br>
                                <input type="password" class="form-control l-inp1" id="" required placeholder="Confirmar Contraseña" name="inp_pwdC">
                                <br>
                                <input type="email" class="form-control l-inp1" id="" required placeholder="Correo" name="inp_correo">
                                <br>
                                <button type="submit" class="btn l-btn1">REGISTRAME</button>
                            </form>
                        </p>
                        <h6><a class="link-registro" href="login.php">Ya tengo sesion</a></h6>
                    </div>
                </div>
            </div>
            <div class="col lg-4"></div>
        </div>
    </div>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    registro($_POST["inp_user"],$_POST["inp_pwd"],$_POST["inp_pwdC"],$_POST["inp_correo"]);
}
?>
</body>
</html>