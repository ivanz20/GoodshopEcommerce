<?php
    session_start();
    require_once("../Model/MensajeModel.php");
    $servicio_mensaje = new Chat();

    if(isset($_SESSION['idusuario'])){
        $mensaje = $_POST['mensaje'];
        if(!empty($mensaje)){
            $servicio_mensaje->nuevo_mensaje($_POST['sender-id'],$_POST['receiver-id'],$_POST['mensaje'],$_POST['idproduct']);
        }
    }else{
        echo '<script type="text/javascript">';
        echo 'window.location.href="sesion.php";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=sesion.php" />';
        echo '</noscript>'; exit;
    }

?>