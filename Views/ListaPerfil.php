<?php require_once("includes/header.php");

$servListas = new ListasUsuario();

$productos = '';

if(isset($_POST['lista-get'])){
    $productos = $servListas->getListProductsByID($_POST['lista-get']);
}

if(isset($_POST['lista-artdelete'])){
    $servListas->DeleteListProductsByID($_POST['lista-artdelete']);
    $url = 'favoritos.php';
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

if(isset($_POST['id_wishlist'])){
    $productos = $servListas->getListProductsByID($_POST['id_wishlist']);
    if(count($productos)<1){
        $servListas->eliminar_lista($_POST['id_wishlist']);
        $url = 'favoritos.php';
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

    else{
        echo '<script type="text/javascript">
        alert("Primero borra todos tus productos"); 
    </script>';
    $url = 'favoritos.php';
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
}   

?>

<br><br>
<div class="container">
    <?php
        $privacidadselect = "<option value='1' SELECTED>Privado</option> <option value='0' >Publico</option>";
        echo "
        <div class='lista-header'>
        <h2 class='titulo-historial'>". $_POST['lista-name'] ."</h2> 
        </div><br><br>
        
        
        ";
        
    ?>
    <br>
    <?php
    foreach($productos  as $results => $row){
        echo "<div class='card-historial row'>
                <div class='contenido-articulo col-3'>
                    <img style='object-fit: cover;' src='data:image/jpeg;base64, " . ($row['fotoproducto']) . "'" . ">
                </div>
                <div class=' contenido-articulo2 col-9'>
                    <h2>" .$row['nombre_producto'] . "</h2>  
                    <p>" . $row['descripcion_producto'] ."</p><!--Consultar descropcion desde base de datos-->
                    <p> $" . $row['precio_producto'] ." MXN</p><!--Consultar descropcion desde base de datos-->
                    <p>Agregado el: " . $row['agregada_en'] . "</p>
                    <div class='btn-listaart' style='display:flex;'>
                    
                    </div>
                  
                </div>   
            </div>
            
            
            ";
        }
    ?>

</div>


<?php include("includes/footer.php");
?>