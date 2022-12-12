<?php
include_once("../Database/Database.php");

class Chat{

    function nuevo_mensaje($incoming, $outgoing, $mensaje,$idproduct){
        echo '<script type="text/javascript">';
        echo 'console.log("hola");';
        echo '</script>';
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_mensajes(1, ". $incoming .",". $outgoing . ",' " . $mensaje . "', ". $idproduct .");";
        if($conn->query($sql) === TRUE){
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $mysqlcon->CloseCon($conn);
    }

    function Get_Messages_By_Sender($sender_id){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_mensajes(2, ". $sender_id .",NULL,NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function Get_Messages_By_Sender_And_Receiver($sender, $receiver){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_mensajes(3, ". $sender .",". $receiver .",NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    function Get_Last_Message_By_User($sender, $receiver){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_mensajes(4, ". $sender .",". $receiver .",NULL, NULL);";
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