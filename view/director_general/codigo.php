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
<body>
    <nav class="navbar navbar-info bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="prestamo.html" style="text-decoration: none !important; color: white !important; font-weight: bold !important;">
                Prestamo</a>
        </div>
    </nav>
    <br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="card text-center">
                    <div class="card-header">
                      Su código es
                    </div>
                    <div class="card-body">
                      <p class="card-text">
                      <?php    
                      echo rand();
                      ?>
                      </p>
                      <a href="prestamo.html" class="btn btn-warning">Cancelar</a>
                      <a href="#" class="btn btn-primary">Enviar</a>
                    </div>
                  </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</body>
</html>