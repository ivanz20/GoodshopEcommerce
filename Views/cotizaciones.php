<?php

use function Clue\StreamFilter\append;

include ("includes/header.php");

if(!isset($_SESSION['idusuario'])){
    echo '<script type="text/javascript">';
    echo 'window.location.href="sesion.php";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=sesion.php" />';
    echo '</noscript>'; exit;
}
require_once("../Database/Database.php");
require_once("../Model/CarritoModel.php");
require_once("../Model/UsuarioModel.php");
require_once("../Model/ProductosModel.php");
require_once("../Model/MensajeModel.php");


$servicio_mensajes = new Chat();
$servicio_usuarios = new UserModel();
$servicio_productos = new GestionProductos();
$CartService = new Cart();

if(isset($_GET['mensaje-coti'])){
    $servicio_mensajes->nuevo_mensaje($_GET['user_cart'],$_GET['user_tosend'],$_GET['mensaje-coti'],$_GET['producto_cart']);
 
}

if(isset($_GET['chat-user'])){
    $userInfoChat = $servicio_usuarios->GetUserById($_GET['chat-user']); 
}

if(isset($_POST['producto_cart'])){
    $cantidad = $_POST['opcion-cantidad'];
    $userid = $_POST['user_cart'];
    $productid = $_POST['producto_cart'];
    $precio = $_POST['precio'];
    $productoCarrito = $servicio_productos->getProductsById($productid);
    $infoProducto = $productoCarrito[0];

    $desc= $infoProducto['descripcion_producto'];
    $nombre =   $infoProducto['nombre_producto'];
    $foto = base64_encode($infoProducto['imagen1']);

    $CartService->AddItemToCart($precio,$desc,$nombre,$cantidad,$foto,$userid,$productid);

}

?>
<div class="container ">
    <br><br>
    <div class="chat">
        <div class="row" style="height: 100%;">
            <div class="col-4" style="height: 100%; border-radius: 20px; overflow-y: scroll; overflow-x: hidden;">

                <?php
                    $usuarios = [];
                    $mensajes = $servicio_mensajes->Get_Messages_By_Sender($_SESSION['idusuario']);                    
                    foreach ($mensajes as $results => $row){
                        if($row['sender_id'] == $_SESSION['idusuario'] || $row['receiver_id'] == $_SESSION['idusuario']){
                            if($row['sender_id'] == $_SESSION['idusuario']){
                                $userInfo = $servicio_usuarios->GetUserById($row['receiver_id']);
                                array_push($usuarios,$row['receiver_id']);
                            }else{
                                $userInfo = $servicio_usuarios->GetUserById($row['sender_id']);
                                array_push($usuarios,$row['sender_id']);
                            }
                           
                        }
                        
                    }
                    $usuariosAux = array_unique($usuarios);
                    foreach ($usuariosAux as $results => $row){
                        $message = $servicio_mensajes->Get_Last_Message_By_User($_SESSION['idusuario'],$row);

                        $userInfo2 = $servicio_usuarios->GetUserById($row);
                        echo "
                        <form method='GET' action='#'>
                            <input type='hidden' name='chat-user' value='" . $userInfo2[0]['id_usuario'] . "'>
                            <button type='submit' id='btn-chats'>
                                <div class='chat-cards'>
                                    <img class='perfil-chat' src='data:image/jpeg;base64, " . base64_encode($userInfo2[0]['avatar_imagen']) . "'" . ">
                                    <h2 class='user-chat'>". $userInfo2[0]['nombre_usuario'] ."</h2>
                                    <p class='mensaje-chathead'>" . $message[0]['mesg'] ."</p>
                                    <p class='fecha-chathead'>Enviado: ". $message[0]['enviadoEn'] ."</p>    
                                </div>  
                            </button>                                  
                        </form>";
                    }
                ?>

            </div>

            <div class="col-8" style="height: 100%; border-radius: 20px;">
            <?php 
                if(isset($_GET['chat-user'])){
                    $userChatActive = $servicio_mensajes->Get_Messages_By_Sender_And_Receiver($_SESSION['idusuario'],$_GET['chat-user']);
                    $message2 = $servicio_mensajes->Get_Last_Message_By_User($_SESSION['idusuario'],$_GET['chat-user']);
                    $product_info = $servicio_productos->getProductsById($message2[0]['productid']);

                    $cantidadArray = [];
                    for($x=1;$x<=$product_info[0]['cantidad_producto'];$x++){
                        $stringCantidad = '<option value=' . $x . '>' .  $x . '</option>';
                        array_push($cantidadArray,$stringCantidad);
                    }

                    echo '<h2>' .$userInfoChat[0]['nombres'] . '  ' . $userInfoChat[0]['apellidopaterno'] .  '</h2>';
                    echo '<div class="row" id="mensaje-container" style="width: 100%; height: 80%; padding: 20px;">
                    <ul class="chat-active" style="width: 100%;">';                   

                    
                    echo '
                    </ul>
                    </div>
                    <form id="form-mensaje" class="row form-mensaje" style="width: 104%; height: 20%; display: inline-flex;">
                        <input type="hidden" id="sender-id" name="sender-id" value="'. $_SESSION['idusuario'] .'">
                        <input type="hidden" id="receiver-id" name="receiver-id" value="' . $_GET['chat-user'] .'">
                        <input id="input-mensaje" class="input-mensaje" name="mensaje" type="text" style="width: 80%; height: 100%; resize: none; border-radius: 0px 0px 0px 20px; padding: 20px; font-family: "Roboto", sans-serif; font-weight: normal;" placeholder="Escribe tu mensaje aqui...">
                        <input type="hidden" id="idproduct" name="idproduct" value="'. $message2[0]['productid'] .'">';

                        if($product_info[0]['vendedor_id'] == $_SESSION['idusuario'] ){
                            echo ' <button data-toggle="modal" data-target="#exampleModal" style="width: 10%;border:none;outline: none; border-radius: 0px 0px 0px 0px;font-family: "Roboto", sans-serif; font-weight: normal; color: white; background-color: grey;">Cotizacion</button>
                            <button id="btn-send" class="btn-send" style="width: 10%;border:none;outline: none; border-radius: 0px 0px 20px 0px;font-family: "Roboto", sans-serif; font-weight: normal; color: white; background-color: black;">Enviar</button>';
                        }else{
                            echo ' 
                            <button id="btn-send" class="btn-send" style="width: 20%;border:none;outline: none; border-radius: 0px 0px 20px 0px;font-family: "Roboto", sans-serif; font-weight: normal; color: white; background-color: black;">Enviar</button>';
                        }
                       
                    echo '
                    </form>';

                    if($product_info[0]['vendedor_id'] == $_SESSION['idusuario'] ){
                    echo '
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Cotización</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="#">

                            <input type="hidden" name="user_cart" id="user_cart" value="' . $_GET['chat-user'] . '">
                            <input type="hidden" name="producto_cart" id="producto_cart" value="'. $product_info[0]['id_producto']  . '">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Costo</label>
                                <input type="text" name="precio" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="MXN">
                            </div>
                            <label for="opcion-cantidad">Cantidad</label>
                            <select id="opcion-cantidad" name="opcion-cantidad" style="width:100% ;"> ' 
                                . implode("", $cantidadArray) . '
                            </select>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Crear Cotización</button>';
                           
                           } 
                        

                        echo '
                        </div>
                        </form>

                      </div>
                    </div>
                  </div>


                    ';
                }
            ?>
              
            </div>


        </div>

    </div>
    <br><br>
</div>
<script type="text/javascript" src="../Views/Script/chat.js"></script>
<?php include("includes/footer.php")?>
