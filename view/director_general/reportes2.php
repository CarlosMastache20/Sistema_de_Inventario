<?php
$id_sucursal = $_POST['id_sucursal'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D|Reportes</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-info bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="reportes.php" style="text-decoration: none !important; color: white !important; font-weight: bold !important;">
                Inicio</a>
        </div>
    </nav>
</body>
<br><br><br>
<div class="container">
    <div class="row text-center">
        <div class="col-lg-12">
            <h4>¿Que tipo de reporte deseas?</h4>
        </div>
    </div>
    <br><br><br>
    <div class="row">
        <div class="col-lg-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">General</h5>
                    <p class="card-text">
                        <br><br>
                        <div class="row">
                            <div class="col-lg-4">
                                <form action="reporte_listaA.php" method="post">
                                    <input hidden type="text" name="reporte" id="" value="General Anual">
                                    <input hidden type="text" name="anio" value="2021">
                                    <input hidden text="text" name="id_sucursal" value='<?php echo $id_sucursal?>'>
                                <button type="submit" class="btn btn-warning">Anual</button>
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <form action="reporte_listaT.php" method="post">
                                    <input hidden type="text" name="reporte" id="" value="General Trimestral">
                                    <input hidden type="text" name="anio" value="2021">
                                    <input hidden text="text" name="id_sucursal" value='<?php echo $id_sucursal?>'>
                                    <input hidden type="text" name="trimestre" value="T1">
                                <button type="submit" class="btn btn-warning">Trimestral</button>
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <form action="reporte_listaM.php" method="post">
                                    <input hidden type="text" name="reporte" id="" value="General Mensual">
                                    <input hidden type="text" name="anio" value="2021">
                                    <input hidden text="text" name="id_sucursal" value='<?php echo $id_sucursal?>'>
                                    <input hidden type="text" name="mes" id="" value="Enero">
                                <button type="submit" class="btn btn-warning">Mensual</button>
                                </form>
                            </div>
                        </div>
                        <br><br><br>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">SUB Categoria</h5>
                    <p class="card-text">
                        <br><br>
                        <div class="row">
                            <div class="col-lg-4">
                                <form action="reporte_listaCA.php" method="post">
                                    <input hidden type="text" name="reporte" id="" value="SUB Categoria Anual">
                                    <input hidden type="text" name="anio" value="2021">
                                    <input hidden text="text" name="id_sucursal" value='<?php echo $id_sucursal?>'>
                                    <input hidden type="text" name="categoria" value="Adhesivos">
                                <button type="submit" class="btn btn-warning">Anual</button>
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <form action="reporte_listaCT.php" method="post">
                                    <input hidden type="text" name="reporte" id="" value="SUB Categoria Trimestral">
                                    <input hidden type="text" name="anio" value="2021">
                                    <input hidden text="text" name="id_sucursal" value='<?php echo $id_sucursal?>'>
                                    <input hidden type="text" name="trimestre" value="T1">
                                    <input hidden type="text" name="categoria" value="Adhesivos">
                                <button type="submit" class="btn btn-warning">Trimestral</button>
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <form action="reporte_listaCM.php" method="post">
                                    <input hidden type="text" name="reporte" id="" value="SUB Categoria Mensual">
                                    <input hidden type="text" name="categoria" value="Adhesivos">
                                    <input hidden type="text" name="anio" value="2021">
                                    <input hidden text="text" name="id_sucursal" value='<?php echo $id_sucursal?>'>
                                    <input hidden type="text" name="mes" id="" value="Enero">
                                <button type="submit" class="btn btn-warning">Mensual</button>
                                </form>
                            </div>
                        </div>
                        <br><br><br>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</Mensual