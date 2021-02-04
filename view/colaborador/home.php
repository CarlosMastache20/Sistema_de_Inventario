<?php
$si="";
session_start();
if(isset($_SESSION['id_sucursal'])){
    $id_sucursal = $_SESSION['id_sucursal'];
}else{
    header("location: ../../../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colaborador</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body class="bodyP">
    <div class="container">
        <div class="row">
            <div class="col lg-12" style="text-align: center;">
                <h1 class="title1">Personal</h1>
                <h5 class="title2">Sucursal <?php echo $id_sucursal ?></h5>
            </div>
        </div>
        <div class="row" style="padding-top: 110px !important;">
            <div class="col-lg-2"></div>
            <div class="col-lg-3">
                <div class="card text-center card1P">
                    <div class="card-body">
                        <p class="card-text">
                        <h1><i class="fas fa-cart-arrow-down"></i></h1>
                        <br>
                            <a href="punto_venta.html"><button type="button" name="" id="" class="btn btn-warning">Punto de venta</button></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-3">
                <div class="card text-center card1P">
                    <div class="card-body">
                        <p class="card-text">
                        <h1><i class="fas fa-file-alt"></i></h1>
                        <br>
                            <a href="inventario.php"><button type="button" name="" id="" class="btn btn-warning">Inventario</button></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <br><br><br><br>
        <div class="row" style="text-align: center;">
            <div class="col-lg-12">
                <form action="../../controller/autenticar/salir.php" method="post">
                    <button type="submit" class="btn btn-salir">Salir</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>