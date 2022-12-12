<?php require_once("includes/header.php");
include ('../Database/Database.php');
include('../Model/WishlistModel.php');
$servListas = new ListasUsuario();

$productos = '';

if(isset($_POST['lista-get'])){
    $productos = $servListas->getListProductsByID($_POST['lista-get']);
}
if(isset($_POST['editdescripcion-categoria'])){
    $imagen = addslashes(file_get_contents($_FILES['editfoto1producto']['tmp_name']));
    $servListas->editarlista($_POST['lista-get'],$_POST['lista-name'],$_POST['editdescripcion-categoria'],$imagen,$_POST['privacidad-editar']);
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
        <a href='#editEmployeeModal' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
        <a href='#deleteEmployeeModal' class='delete' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>
        </div><br><br>
        <div id='deleteEmployeeModal' class='modal fade'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <form method='POST' >
                                        <input type='hidden' id='id_wishlist' name='id_wishlist' value='". $_POST['lista-get'] ."'>
                                        <div class='modal-header'>						
                                            <h4 class='modal-title'>Eliminar Wishlist</h4>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        </div>
                                        <div class='modal-body'>					
                                            <p>¿Esta seguro de eliminar esta Wishlist?</p>
                        
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='button' class='btn btn-default' data-dismiss='modal' value='Cancelar'>
                                            <input type='submit' class='btn btn-danger' value='Eliminar'>
                                        </div>
                                    </form>
                                </div>
                            </div>
        </div>
        <!-- Edit Modal HTML -->
                        <div id='editEmployeeModal' class='modal fade'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <form method='post' action='#' enctype='multipart/form-data'>
                                        <input type='hidden' id='lista-get' name='lista-get' value='" . $_POST['lista-get'] . "'>
                                        <div class='modal-header'>						
                                            <h4 class='modal-title'>Editar Wishlist</h4>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        </div>
                                        <div class='modal-body' class='form-cambiarlista'>					
                                            <div class='form-group'>
                                                <label>Nombre de Wishlist</label>
                                                <input type='text' id='lista-name' name='lista-name' class='form-control' value='' required>
                                            </div>
                                            <div class='form-group'>
                                                <label>Descripcion</label>
                                                <input type='text' class='form-control' id='editdescripcion-categoria' name='editdescripcion-categoria' value='' required>
                                            </div>
                                            <br>

                                            <div class='custom-file'>
                                            
                                                <input type='file' class='custom-file-input' id='editfoto1producto' name='editfoto1producto' required>
                                                <label class='custom-file-label' for='editfoto1producto'>Foto de Lista</label>
                                            </div>
                                            <br>                                            <br>
                                            <label>Privacidad</label>

                                            <select id='privacidad-seleccionar' name='privacidad-editar' required>"
                                            . $privacidadselect . "
                                            </select>
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='button' class='btn btn-default' data-dismiss='modal' value='Cancel'>
                                            <input type='submit' class='btn btn-info' value='Editar'>
                                        </div>
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
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
                    <p>Agregado el: " . $row['agregada_en'] . "</p>
                    <div class='btn-listaart' style='display:flex;'>
                    <form method='post' action='#'>
                        <input type='hidden' name='lista-artdelete' value='" . $row['idlistproduct'] . "'>
                        <input type='hidden' name='lista-get' value='" . $row['id_wishlist'] . "'>
                        <input type='hidden' name='lista-name' value='" . $_POST['lista-name']. "'>
                        <button type='submit' style='background-color: red;'>Eliminar Articulo</button>
                    </form>
                    </div>
                  
                </div>   
            </div>
            
            
            ";
        }
    ?>

</div>


<?php include("includes/footer.php");
?>