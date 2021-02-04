<?php

include ('../../model/productos.php');


//Función para valores de texto permitidos
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function alta(string $producto, string $marca, int $precio, int $cantidad, string $clasificacion, string $detalles){

    include ('../../DB/db.php');

    $pro = $mar = $cla = $deta = "";
    $pre = $cant = $id_producto = 0;

    $nuevo_producto = new Producto();

    $nuevo_producto->set_Nombre(test_input($producto));
    $nuevo_producto->set_Marca(test_input($marca));
    $nuevo_producto->set_Precio(test_input($precio));
    $nuevo_producto->set_Existencia(test_input($cantidad));
    $nuevo_producto->set_Categoria(test_input($clasificacion));
    $nuevo_producto->set_Detalles(test_input($detalles));

    //Creacion de la conexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Verifica la conexion
    if($conn->connect_error){
        die("Error en la conexion: " . $conn->connect_error);
    }else{

        $pro = $nuevo_producto->get_Nombre();
        $mar = $nuevo_producto->get_Marca();
        $pre = $nuevo_producto->get_Precio();
        $cant = $nuevo_producto->get_Existencia();
        $cla = $nuevo_producto->get_Categoria();
        $deta = $nuevo_producto->get_Detalles();

        //Comprobamos que el nombre del producto no se repita

        $sql = "SELECT nombre from productos where nombre = '".$pro."'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo '
            <br><br>
            <div class="alert alert-danger text-center" role="alert">
                Producto existente, intente poniendole un distintivo, por ejemplo Lapiz10 o LapizA
            </div>
            ';
        }else{

            $sql2 = "INSERT INTO productos (nombre, marca, precio, id_clasificacion, detalles)
            values ('".$pro."','".$mar."','".$pre."','".$cla."','".$deta."')";

            if (mysqli_query($conn, $sql2)) {

                //Ahora falta agregarlo a los inventarios generales
                //Elegimos la ultima inserccion

                $ultimo = $conn->query($ultimo_id);

                if($ultimo->num_rows > 0){
                    while($row=mysqli_fetch_array($ultimo)){
                        $array = array($row["id_producto"]);

                        $id_producto = $array[0];

                        $sql3 = "INSERT INTO inventarios (Id_producto,Id_sucursal,existencia) 
                        values ('".$id_producto."',1,'".$cant."'),
                        ('".$id_producto."',2,'".$cant."'),
                        ('".$id_producto."',3,'".$cant."'),
                        ('".$id_producto."',4,'".$cant."'),
                        ('".$id_producto."',5,'".$cant."')";

                        if(mysqli_query($conn,$sql3)){
                            echo '
                            <br><br>
                            <div class="alert alert-info text-center" role="alert">
                            Su producto ha sido agregado
                            </div>
                            ';
                        }else{
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    }
                }

            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        $conn->close();
    }

}

?>