<?php 
include("includes/header.php");
require_once("../config.php");
require_once("../Model/CarritoModel.php");

$CartService = new Cart();



if(!isset($_SESSION['idusuario'])){
    echo '<script type="text/javascript">';
    echo 'window.location.href="sesion.php";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=sesion.php" />';
    echo '</noscript>'; exit;
}
$idUser = $_SESSION['idusuario'];
$user_carrito = $CartService->GetItemsFromCartByUser($idUser);

if(isset($_POST['idproducto'])){
    $idproducto = $_POST['idproducto'];
    $CartService->DeleteItemFromCart($idproducto);
    $url = 'carrito.php';
        if (!headers_sent())
        {    
            header('Location: '.$url);
            exit;
            }
        else
            {  
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.$url.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
            echo '</noscript>'; exit;
        }
}

?>


<div class="container">
    <br><br>
    <h2 class="titulo-historial">Carrito</h2>
    <br>
    <?php
    $sumaObjetos = 0;
    foreach ($user_carrito as $results => $row){
        $preciototal = $row['precio_carrito'] * $row['cantidad'];
        $sumaObjetos = $sumaObjetos + $preciototal;
        echo "<div class='card-cart row'>
                <div class='contenido-articulo col-3'>
                <img style='height: 300px; width: 300px; object-fit: cover;' src='data:image/jpeg;base64, " . $row['fotoproducto'] . "'" . ">
                </div>
                <div class=' contenido-articulo2 col-9'>
                <br>
                <br>
                    <h2>". $row['nombre_carrito'] ."</h2>
                    <!-- Consultar info desde tabla de historial -->
                    <p>Costo unitario: $".  $row['precio_carrito'] ." MXN</p>
                    <p>Cantidad: ".  $row['cantidad'] ."</p>
                    <p>Total: $".  $preciototal ." MXN</p>
                    <form method='POST' action='#'>
                        <input type='hidden' id='idproducto' name='idproducto' value='" . $row['id_carrito'] ."'>
                        <button type='submit' style='background-color:red;'>Eliminar Artículo</button>
                    </form>
                    
                </div>   
            </div><br><br>";
    }
        echo '<br>
        <h2 class="titulo-historial" STYLE="text-align: right">  Total: $' . $sumaObjetos  . ' MXN</h2>';
    ?>
    
    <br>
    <div class="mx-auto text-center" >
    <form action="../Model/charge.php" method="post">
            <?php
                echo '<input type="hidden"  name="amount" class="titulo-historial" STYLE="text-align: right"  value="' . $sumaObjetos  . '"></input>';
            ?>
            
            <input type="submit" id="boton-comprar" name="submit-pay" value="Pagar Ahora">
        </form>
    </div>
    <br><br>
</div>
<?php include("includes/footer.php"); ?>

