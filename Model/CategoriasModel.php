<?php

class GestionCategorias{


    function agregar_categoria($nombre, $descripcion, $userid){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_categorias(1, NULL, '" . $nombre . "','" . $descripcion . "', NULL," . $userid . ");";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Categoria Registrada"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function editar_categoria($idcategoria, $nombre, $description){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_categorias(2," . $idcategoria . ", '" . $nombre . "','" . $description . "', NULL,NULL);";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Categoria Editada"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function eliminar_categoria($idcategoria){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_categorias(3," .  $idcategoria . ",NULL,NULL, NULL,NULL);";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Categoria Eliminada"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function selectCategorias(){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "select * from categoria_productos;";
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
