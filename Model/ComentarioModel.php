<?php

class GestionComentarios{

    function agregar_comentario($comentario, $estrellas,$idproducto, $idusuario){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_comentarios(1,'" . $comentario . "'," . $estrellas . "," . $idproducto . "," . $idusuario . ");";
        if($conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
            alert("Comentario Hecho"); 
            </script>';
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function GetAllByProductID($idproducto){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_comentarios(5,NULL,NULL," . $idproducto . ",NULL);";
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