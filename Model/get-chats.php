<?php
 session_start();
 require_once("../Model/MensajeModel.php");
 require_once ('../Model/UsuarioModel.php');

 $servicio_mensaje = new Chat();
 $servicio_usuarios = new UserModel();

 if(isset($_SESSION['idusuario'])){
        $userChatActive = $servicio_mensaje->Get_Messages_By_Sender_And_Receiver($_SESSION['idusuario'],$_POST['receiver-id']);
        $output ='';

        foreach ($userChatActive as $results => $row){
            if($row['sender_id'] == $_SESSION['idusuario']){
                $userInfo = $servicio_usuarios->GetUserById($row['sender_id']);
                $output .= '<li><div class="mensaje-bubble-enviado">
                    <p>'. $userInfo[0]['nombre_usuario'] .'</p>
                    <p>' . $row['mesg'] .'</p>
                    <p>Enviado el: '. $row['enviadoEn'] .'</p>
                    </div></li>';
            }else{
                $userInfo2 = $servicio_usuarios->GetUserById($row['sender_id']);
                $output .= '
                <li><div class="mensaje-bubble-recibido">
                    <p>'. $userInfo2[0]['nombre_usuario'] .'</p>
                    <p>' . $row['mesg'] . '</p>
                    <p>Enviado el: '. $row['enviadoEn'] .'</p>
                </div></li>
                ';
            }

        }
        echo $output;
    }
 else{
     echo '<script type="text/javascript">';
     echo 'window.location.href="sesion.php";';
     echo '</script>';
     echo '<noscript>';
     echo '<meta http-equiv="refresh" content="0;url=sesion.php" />';
     echo '</noscript>'; exit;
 }

?>
