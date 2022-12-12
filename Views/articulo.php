<?php include("includes/header.php");

// print_r($_GET);

// print_r($producto);
include ('../Database/Database.php');
include("../Model/WishlistModel.php");
include("../Model/CarritoModel.php");
include("../Model/UsuarioModel.php");
include("../Model/ComentarioModel.php");

include("../Model/ProductosModel.php");
$idArticulo = $_GET['articulo'];

$productosServicio = new GestionProductos();

$productoVista = $productosServicio->getProductsById($idArticulo);
$infoArticulo = $productoVista[0];

$servListas = new ListasUsuario();

$CartService = new Cart();

$UserService = new UserModel();

$ComentarioService = new GestionComentarios();

$visitas = $infoArticulo['visitas_producto'] + 1;

$productosServicio->ProductVisited($idArticulo,$visitas);



if(isset($_POST['opcion-lista'])){
    $nameproducto = $infoArticulo['nombre_producto'];
    $precioproducto = $infoArticulo['precio_producto'];
    $descripcion = $infoArticulo['descripcion_producto'];
    $foto = base64_encode($infoArticulo['imagen1']);
    $wishid = $_POST['opcion-lista'];

    $guardar = $infoArticulo['guardado_wishlist'] + 1;
    $productosServicio->ProductOnList($idArticulo,$guardar);
    $servListas->agregarProductoALista($nameproducto,$precioproducto,$descripcion,$foto,$wishid);
}

if(isset($_POST['producto_cart'])){

    $cantidad = $_POST['opcion-cantidad'];
    $userid = $_POST['user_cart'];
    $productid = $_POST['producto_cart'];
    $productoCarrito = $productosServicio->getProductsById($productid);
    $infoProducto = $productoCarrito[0];

    $precio = $infoProducto['precio_producto'];
    $desc= $infoProducto['descripcion_producto'];
    $nombre =   $infoProducto['nombre_producto'];
    $foto = base64_encode($infoProducto['imagen1']);

    $ventas = $infoArticulo['ventas_producto'] + 1;

    $productosServicio->ProductOnCart($idArticulo,$ventas);

    $CartService->AddItemToCart($precio,$desc,$nombre,$cantidad,$foto,$userid,$productid);

}

if(isset($_POST['comentario-articulo'])){
    $ComentarioService->agregar_comentario($_POST['comentario-articulo'],$_POST['estrellas'],$_POST['idproducto-comment'],$_POST['iduser-coment']);
}

?>
<div class="container">
    <div class="row articulo-vista">

        <?php
            $userinfo = $UserService->GetUserById($infoArticulo['vendedor_id']);
            echo "
            <img class='col-6 foto-vista' style='object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($infoArticulo['imagen1']) . "'" . ">
            <div class='col-6 textos-articulos'>
            <h2><strong>". $infoArticulo['nombre_producto'] ."</strong></h2> <!--Consultar Nombre desde la basde datos-->
            <br>
            ";
            if($infoArticulo['cotizacion'] == 0){
                echo "<h3>$". $infoArticulo['precio_producto'] ." MXN</h3>";
            }

            echo "
            <br>
            <p>" .$infoArticulo['descripcion_producto'] ."</p>";

            

             
            
            echo "
            <div>
            <form method='POST' action='perfilusuario2.php'>
                    <input type='hidden' name='id_user_articulo' value='". $userinfo[0]['id_usuario']  . "'>
                    <label for='btn-user-articulo'>Vendido por: </label>
                    <button class='btn-user-articulo' id='btn-user-articulo' type='submit'>".  $userinfo[0]['nombre_usuario'] ."</button>
            </form> 
            </div>

            
            <br><br><br>
            ";
            echo "
            <div class='estrellas'>
            <h3>Calificación:" ;
            $numestrellas = $infoArticulo['promedio_calificacion'];
            for ($stars=0; $stars<$numestrellas; $stars++){
                echo '<i class="fa-solid fa-star"></i>';
            }
            $numestrellasVacias = 5 - $numestrellas;
            for ($stars2=0; $stars2<$numestrellasVacias; $stars2++){
                echo '<i class="fa-regular fa-star"></i>';
            }
            echo "</h3></div>";
        ?>

          <?php
                $cantidadArray = [];
                for($x=1;$x<=$infoArticulo['cantidad_producto'];$x++){
                    $stringCantidad = '<option value=' . $x . '>' .  $x . '</option>';
                    array_push($cantidadArray,$stringCantidad);
                }
            if($infoArticulo['cotizacion'] == 1){
                echo ' <div class="ayudaxd">
                
                <div  class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" id="modal-cotizacion">
                            <form method="GET" action="cotizaciones.php" id="addcarrito" >
                                <input type="hidden" name="user_cart" id="user_cart" value="' . $_SESSION['idusuario'] . '">
                                <input type="hidden" name="user_tosend" id="user_tosend" value="' . $userinfo[0]['id_usuario'] . '">
                                <input type="hidden" name="producto_cart" id="producto_cart" value="'. $infoArticulo['id_producto']  . '">
                                <label for="mensaje-coti" class="form-label">Enviale un mensaje a '. $userinfo[0]['nombres'] . ' ' .  $userinfo[0]['apellidopaterno'] .  '</label>
                                <input type="text" name="mensaje-coti" class="form-control" id="mensaje-coti" value = "Hola '. $userinfo[0]['nombres'] . ' ' .  $userinfo[0]['apellidopaterno'] .  ', quiero una cotización del siguiente articulo.' .$infoArticulo['nombre_producto'] .' Gracias.">       
                                <button type="submit" id="btn-carrito2">Enviar mensaje al vendedor</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <button type="button" class="btn btn-primary" id="btn-carrito2" data-toggle="modal" data-target=".bd-example-modal-lg">Pedir Cotización</button>
                
                </div>';

            }else {
             echo '
             <div class="ayudaxd">
            <form method="POST" action="#" id="addcarrito" >
                <select id="opcion-cantidad" name="opcion-cantidad"> ' 
                    . implode("", $cantidadArray) . '
                </select>
                <input type="hidden" name="user_cart" id="user_cart" value="' . $_SESSION['idusuario'] . '">
                <input type="hidden" name="producto_cart" id="producto_cart" value="'. $infoArticulo['id_producto']  . '">
                <button type="submit" id="btn-carrito">Agregar a Carrito</button>
            </form>
            
            </div>';
            }
            ?>


            <br>


            <form method="POST" action="#" id="form-wishlist">
                <select id='opcion-lista' name="opcion-lista">
                <?php
                $listasUsuario = $servListas->getListByUser($_SESSION['idusuario']);
                foreach($listasUsuario as $results => $row){
                    echo "<option value=" . $row['id_wishlist'] . ">" .  $row['nombre_lista'] . "</option>";
                }
                ?>
                </select>
                <button type='submit'>Agregar a Wishlist</button>
            </form>
         




        </div>
        

    </div>
    <br>

    <!--Consultar imagenes y videdo de la abse de datos-->

    <div class="row imagenes-articulo" style="display: inline-block; margin-left: -5px;">
    <?php
        echo "
        <button data-toggle='modal' data-target='.imagen1-modal'><img class='fotos-articulo' style='object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($infoArticulo['imagen1']) . "'" . "  width='100'></button>
        <button data-toggle='modal' data-target='.imagen2-modal'><img class='fotos-articulo' style='object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($infoArticulo['imagen2']) . "'" . " width='100'></button>
        <button data-toggle='modal' data-target='.imagen3-modal'><img class='fotos-articulo' style='object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($infoArticulo['imagen3']) . "'" . " width='100'></button>
        <button data-toggle='modal' data-target='.video-modal'><img class='fotos-articulo' style='object-fit: cover;' src='img/video-icon.jpg ' width='100'></button>
        
        

        <div  class='modal fade imagen1-modal' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-lg'>
                <div class='modal-content' id='modal-cotizacion'>
                    <img class='fotos-galeria' style='object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($infoArticulo['imagen1']) . "'" . "  width='1000px'>
                </div>
            </div>
        </div>

        <div  class='modal fade imagen2-modal' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-lg'>
                <div class='modal-content' id='modal-cotizacion'>
                    <img class='fotos-galeria' style='object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($infoArticulo['imagen2']) . "'" . "  width='1000px'>
                </div>
            </div>
        </div>
        
        <div  class='modal fade imagen3-modal' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-lg'>
                <div class='modal-content' id='modal-cotizacion'>
                    <img class='fotos-galeria' style='object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($infoArticulo['imagen3']) . "'" . "  width='1000px'>
                </div>
            </div>
        </div>

        <div  class='modal fade video-modal' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-lg'>
                <div class='modal-content' id='modal-cotizacion'>
                <div content='Content-Type: video/mp4'>
                    <video width='700' height='450' controls='controls' poster='image' preload='metadata'>
                        <source src='data:video/mp4;base64,".base64_encode($infoArticulo['video'])."'/>;
                    </video>
                </div>
                </div>
            </div>
        </div>
        
        "
    ?>
    </div>
    <br><br><br><br><br>

    <div class="container text-center ">
        <h2 id="masarticulos">Reviews</h2>
      
        <br><br>
        <form action="#" method="post">
            <?php
                echo '  <input type="hidden" name="iduser-coment" id="iduser-coment" value="' . $_SESSION['idusuario'] . '">
                <input type="hidden" name="idproducto-comment" id="idproducto-comment" value="'. $infoArticulo['id_producto']  . '">';
            ?>
            <div class="form-row">
            <div class="form-group col-md-10">
                <label for="comentario-articulo">Comentario</label>
                <textarea class="form-control" id="comentario-articulo" name="comentario-articulo" rows="3"></textarea>
            </div>
            <div class="form-group col-2">
            <label for="estrellas">Puntuación</label>
                <select id="estrellas" name="estrellas" class="form-control">
                    <option  value="1">1 Estrella</option>
                    <option value="2">2 Estrellas</option>
                    <option value="3">3 Estrellas</option>
                    <option value="4">4 Estrellas</option>
                    <option selected value="5">5 Estrellas</option>
                </select>
            </div>
           
        </div>
            <button type="submit" id='btn-comentario'>Publicar</button>
        </form>
    </div>
    <br><br>
    <div class="container" style="display: inline;">
        <div class="row">
        <?php
            $comentarios = $ComentarioService->GetAllByProductID($infoArticulo['id_producto']);

            foreach($comentarios as $results => $row){
                echo '<div class="col-3">
                <div class="review-card">
                    <img class="rounded-circle" src="data:image/jpeg;base64, ' . base64_encode($row['avatar_imagen']) . '"' . ' >

                    <h4>'. $row['nombre_usuario'] .'</h4>
                    <div class="estrellas">' ;
                        $numestrellas = $row['estrellas_calificacion'];
                        for ($stars=0; $stars<$numestrellas; $stars++){
                            echo '<i class="fa-solid fa-star"></i>';
                        }
                        $numestrellasVacias = 5 - $numestrellas;
                        for ($stars2=0; $stars2<$numestrellasVacias; $stars2++){
                            echo '<i class="fa-regular fa-star"></i>';
                        }

                echo '
                    </div>
                    <div class="contenido-neto">
                        <p>'. $row['comentario_usuario'] .'</p>
                        <p>Puntuacion: ' . $row['estrellas_calificacion'] .'/5 estrellas</p>
                        <p>Publicado: '. $row['fecha_creacion'] .'</p>
                    </div>
                </div>
            </div>';    
            }   
        ?>
        </div>
        
    </div>
    
</div>
<?php include("includes/footer.php"); ?>
