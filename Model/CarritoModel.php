<?php
class Cart{

    function AddItemToCart($precio, $desc, $nombre, $cantidad, $foto, $iduser, $idproducto){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_carrito(1," . $precio . ",'" . $desc . "','" . $nombre . "', " . $cantidad . ",'" . $foto . "', " . $iduser . ",NULL," . $idproducto . ",NULL,NULL,NULL,NULL);";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Producto agregado a carrito"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function DeleteItemFromCart($idcarrito){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_carrito(3,NULL,NULL,NULL,NULL,NULL,NULL," . $idcarrito . ",NULL,NULL,NULL,NULL,NULL);";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Producto Eliminado del carrito"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function GetItemsFromCartByUser($iduser){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_carrito(4,NULL,NULL,NULL,NULL,NULL," . $iduser . ",NULL,NULL,NULL,NULL,NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function WhenOrderIsPurchased($OrderID){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_carrito(5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'". $OrderID ."',NULL,NULL,NULL);";
        if($conn->query($sql) === TRUE){
            
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function GetAllOrdersByVendor($vendorid){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_carrito(7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL," . $vendorid . ",NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function GetAllOrdersByCategory($categoria){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_carrito(9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL," . $categoria . ",NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function GetAllOrdersByDate($date1, $date2, $vendorid){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_carrito(8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL," .$vendorid . ",'".$date1 ."','". $date2 ."');";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function GetAllOrdersByDateGroup($date1, $date2, $vendorid){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_carrito(10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL," .$vendorid . ",'".$date1 ."','". $date2 ."');";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function GetAllOrdersByCategoryGroup($categoria){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_carrito(11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL," . $categoria . ",NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function GetAllOrdersByBuyer($buyerid){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_carrito(12,NULL,NULL,NULL,NULL,NULL,". $buyerid. ",NULL,NULL,NULL,NULL,NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function GetAllOrdersByBuyerByDate($date1, $date2,$buyerid){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_carrito(13,NULL,NULL,NULL,NULL,NULL,". $buyerid. ",NULL,NULL,NULL,NULL,'" . $date1 . "','" . $date2 ."');";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function GetAllOrdersByBuyerByCategory($buyerid){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_carrito(12,NULL,NULL,NULL,NULL,NULL,". $buyerid. ",NULL,NULL,NULL,NULL,NULL,NULL);";
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