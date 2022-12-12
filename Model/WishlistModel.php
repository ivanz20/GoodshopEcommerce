<?php 

class ListasUsuario{


    function crear_lista($NombrelLista,$ListaDesc,$ListaIcono,$privacidadlista, $iduser){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_listas(1, NULL, '" . $NombrelLista . "','" . $ListaDesc . "','". $ListaIcono . "'," . $privacidadlista . "," . $iduser . ");";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Lista Registrada"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function eliminar_lista($idlista){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_listas 
        (3," . $idlista . ",NULL,NULL,NULL,NULL,NULL);";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Lista Eliminada"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }
    function editarlista($idlista,$NombrelLista,$ListaDesc,$ListaIcono,$privacidadlista){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_listas(2, ". $idlista .", '" . $NombrelLista . "','" . $ListaDesc . "','". $ListaIcono . "'," . $privacidadlista . ",NULL);";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Lista Editada"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function getListByUser($iduser){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_listas 
        (4,NULL,NULL,NULL,NULL,NULL," . $iduser . ");";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    




    //Productos lista

    function agregarProductoALista($nombre, $precio, $descripcion, $foto, $wishlist){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productoswish(1, '" . $nombre . "'," . $precio . ",'". $descripcion . "','" . $foto . "'," . $wishlist . ",NULL);";
        
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Producto agregado a la lista"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);

    }

    function getListProductsByID($idlista){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productoswish 
        (2,NULL,NULL,NULL,NULL," . $idlista . ",NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function DeleteListProductsByID($idlista){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_productoswish 
        (3,NULL,NULL,NULL,NULL,NULL," . $idlista . ");";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Producto Eliminado de Wishlist"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }


}

?>