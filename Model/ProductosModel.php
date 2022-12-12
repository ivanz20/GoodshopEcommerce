<?php 
include_once("../Database/Database.php");


class GestionProductos{

    function agregar_producto($nombre, $descripcion, $imagen1, $imagen2, $imagen3, $video, $esVenta, $esCotizacion, $precio,
    $cantidad, $vendedorid, $categoria){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (1,
        NULL,'" .
        $nombre . "','" .
        $descripcion . "','" .
        $imagen1 . "','" .
        $imagen2 . "','" .
        $imagen3 . "','".
        $video . "'," .
        $esVenta . "," .
        $esCotizacion . "," .
        $precio . "," .
        $cantidad . "," . "
        0,
        0,
        0,
        0," .
        $vendedorid . "," .
        $categoria . ",
        NULL,NULL);";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Producto Registrado"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function editar_producto($idproducto, $nombre, $descripcion, $imagen1, $imagen2, $imagen3, $video, $esVenta, $esCotizacion, $precio,
    $cantidad, $vendedorid, $categoria){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (2, " . 
        $idproducto . ",'" .
        $nombre . "','" .
        $descripcion . "','" .
        $imagen1 . "','" .
        $imagen2 . "','" .
        $imagen3 . "','".
        $video . "'," .
        $esVenta . "," .
        $esCotizacion . "," .
        $precio . "," .
        $cantidad . "," . "
        0,
        0,
        0,
        0," .
        $vendedorid . "," .
        $categoria . ",
        NULL,NULL);";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Producto Editado"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }


    function deleteProduct($productid){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (3," . $productid . ",NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL);";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Producto Eliminado"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }


    function getProductsByUser($user_id){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (7,
        NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0," .
        $user_id . ",NULL,NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function getAllProducts(){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "select * from producto;";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function getProductsById($product_id){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (4," . $product_id . ",NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function searchByName($name){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (5,
        NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,'". $name ."',NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function searchByNamePrecioMayorAMenor($name){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (8,
        NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,'". $name ."',NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }
    
    function searchByNamePrecioMenorAMayor($name){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (9,
        NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,'". $name ."',NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function searchByNameMejorCalificados($name){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (10,
        NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,'". $name ."',NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function searchByAuth(){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (11,
        NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function UpdateAprob($idproducto, $idadmin){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (12,". $idproducto . ",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL," . $idadmin .");";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Producto Aprobado"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function searchByAdminID($idadmin){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (13,
        NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,". $idadmin .");";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function ProductVisited($idproducto,$nuevacantidas){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (14,
        ". $idproducto .",NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,".$nuevacantidas.",0,NULL,NULL,NULL,NULL);";
        if($conn->query($sql) === TRUE){
          
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    
    function ProductOnList($idproducto,$nuevacantidas){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (15,
        ". $idproducto .",NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,".$nuevacantidas.",NULL,NULL,NULL,NULL);";
        if($conn->query($sql) === TRUE){
          
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function ProductOnCart($idproducto,$nuevacantidas){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (16,
        ". $idproducto .",NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0," . $nuevacantidas .",0,0,NULL,NULL,NULL,NULL);";
        if($conn->query($sql) === TRUE){
          
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function ProductosRecienLlegados(){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (17,NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }
    
    function ProductosPopulares(){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (18,NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function ProductosMasVendidos(){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (19,NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function ProductosRecomedados(){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productos 
        (20,NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }
}

?>