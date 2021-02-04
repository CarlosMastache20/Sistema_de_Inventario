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
    <title>A|Alta</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/e530d88f76.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/9a3779baf9.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
</head>
<?php
include ('../../controller/inventario/inventario.php');
?>
<body>
    <nav class="navbar navbar-info bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php" style="text-decoration: none !important; color: white !important; font-weight: bold !important;">
                Inicio</a>
        </div>
    </nav>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <br><br>
                <div class="card text-center">
                    <div class="card-header">
                        Formulario para solicitar material
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Solicitar Material</h5>
                        <form action="../../controller/prestamo/ProcesoPres.php" method="post">
                            <label for="">Producto</label><br>
                            <select name="nombre" id="">
                            <?php
                            productos_sucursal($id_sucursal);
                            ?>
                            </select><br>
                            <label for="">Cantidad</label><br>
                            <input type="number" min="1" name="cantidad" id="" required>
                            <input hidden type="text" name="id_sucursal" id="" value='<?php echo $id_sucursal?>'>
                            <br> <br>
                            <button type="submit" class="btn btn-success">Solcitar Material</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-5">
                <div class="card text-center">
                    <div class="card-header">
                        Formulario para baja de material
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Bajar Material</h5>
                        <form action="../../controller/baja_alta/ProcesoBaja.php" method="post">
                            <label for="">Producto</label><br>
                            <select name="nombre" id="">
                            <?php
                            productos_sucursal($id_sucursal);
                            ?>
                            </select><br><br>
                            <textarea name="detalles" id="" cols="35" rows="5"></textarea><br>
                            <input hidden type="text" name="id_sucursal" id="" value='<?php echo $id_sucursal?>'>
                            <br> <br>
                            <button type="submit" class="btn btn-danger">Solicitar Baja</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>