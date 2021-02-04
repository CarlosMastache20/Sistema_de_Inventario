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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
</head>
<body>
    <nav class="navbar navbar-info bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php" style="text-decoration: none !important; color: white !important; font-weight: bold !important;">
                Inicio</a>
        </div>
    </nav>
    <br>
    <?php
    include ('../../controller/baja_alta/alta.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="card text-center">
                    <div class="card-body">
                      <h5 class="card-title">Alta de producto</h5>
                      <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <label for="">Producto</label><br>
                        <input  required type="text" name="producto" id=""><br>
                        <label for="">Marca</label><br>
                        <input  required type="text" name="marca" id=""><br>
                        <label for="">Precio</label><br>
                        <input  required type="number" min="1" name="precio" id=""><br>
                        <label for="">Cantidad</label><br>
                        <input  required type="number" min="1" name="cantidad" id=""><br>
                        <br>
                        <label for="">Clasificación</label><br>
                        <select required  name="categoria" id="">
                          <option value="1">Articulos Escolares</option>
                          <option value="2">Articulos de Oficina</option>
                          <option value="3">Adhesivos</option>
                          <option value="4">Material Didactico</option>
                          <option value="5">Papeles</option>
                          <option value="6">Fiesta y Decoracion</option>
                        </select><br><br>
                        <textarea name="detalles" id="" cols="30" rows="3"></textarea><br><br>
                        <button type="submit" class="btn btn-primary">Listo</button>
                      </form>
                    </div>
                  </div>
                  <br><br>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
    <?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    alta($_POST["producto"],$_POST["marca"],$_POST["precio"],$_POST["cantidad"],$_POST["categoria"], $_POST["detalles"]);
}
?>
</body>
</html>