<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D|General</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>


<body class="bodyP">
    <div class="container">
        <div class="row">
            <div class="col lg-12" style="text-align: center;">
                <h1 class="title1">Administrador</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                include ('../../controller/baja_alta/solibajas.php');
                contador_bajas();
                ?>
            </div>
        </div>
        <div class="row" style="padding-top: 110px !important;">
            <div class="col-lg-4">
                <div class="card text-center card1P">
                    <div class="card-body">
                        <p class="card-text">
                        <h1><i class="fas fa-chart-line"></i></h1>
                        <br>
                        <a href="alta.php"><button type="button" name="" id="" class="btn btn-warning">Alta</button></a>
                        <a href="baja.php"><button type="button" name="" id="" class="btn btn-danger">Baja</button></a>
                    </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-center card1P">
                    <div class="card-body">
                        <p class="card-text">
                        <h1><i class="fas fa-file-alt"></i></h1>
                        <br>
                            <a href="I-general.php"><button type="button" name="" id="" class="btn btn-warning">Inventario</button></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-center card1P">
                    <div class="card-body">
                        <p class="card-text">
                        <h1><i class="fas fa-chart-bar"></i></h1>
                        <br>
                            <a href="reportes.php">
                            <button type="button" name="" id="" class="btn btn-warning">Reportes</button></a>
                        </p>
                    </div>
                </div>
            </div>
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