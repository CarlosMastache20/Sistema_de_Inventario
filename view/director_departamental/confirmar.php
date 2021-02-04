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
    <title>D|Prestamo</title>
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
include ('../../controller/prestamo/confirmarCodigo.php');
?>
<div class="container">
  <div class="row">
      <?php
      msg_codigo($id_sucursal);
      ?>
  </div>
  <br>
    <div class="row">
      <br>
      <div class="col-lg-12">
<!--Tabla-->
        <table id="example" class="table table-bordered  display nowrap" cellspacing="0" width="100%">
          <thead class="thead">
            <tr>
              <th>Codigo de Préstamo</th>
              <th>Confirmar</th>
            </tr>
          </thead>
          <tbody>
            <tr class="tr">
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <td>
                    <input type="text" name="codigo" class="form-control" required>
                    <td>
                    <input  hidden type="text" name="id_sucursal" id="" value='<?php echo $id_sucursal ?>'>
                        <button type="submit" class="btn btn-primary">Pedir</button>
                    </td>
                </form>
            </tr>
            </tbody>
            <tfoot class="thead">
            <tr>
              <th class="tr_op3">Codigo de Préstamo</th>
              <th>Confirmar</th>
            </tr>
            </tfoot>
        </table>  
      </div>
    </div> 
  </div>
  <br>
  <div class="container text-center">
    <div class="row">
      <div class="col-lg-12">
      <!--Funcion para la alerta de actualizacion y correcto UPDATE en base de datos
      Ya que si confirma el codigo afectaria la base de datos de la sucursal y general-->
      <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
          confirmar_codigo_actualizar($_POST["codigo"],$_POST['id_sucursal']);
      }
      ?>
      </div>
    </div>
  </div>
  <!--Tabla-->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable({
          responsive: true,
          "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar: ",
            "oPaginate": {
              "sFirst":"Primero",
              "sLast":"Último",
              "sNext":"Siguiente",
              "sPrevious":"Anterior"
            },
            "sProcessing":"Procesando...",
          }
      });
  } );  
  </script>


</body>
</html>