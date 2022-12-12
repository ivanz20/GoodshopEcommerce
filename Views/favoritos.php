<?php include("includes/header.php");

include ('../Database/Database.php');
include('../Model/WishlistModel.php');
$servListas = new ListasUsuario();


if(isset($_POST['nombre-lista'])){
    $nombrelista = $_POST['nombre-lista'];
    $descrlista = $_POST['descripcion-lista'];
    $fotoLista = addslashes(file_get_contents($_FILES['foto-lista']['tmp_name']));
    // $fotoLista = '';
    $privacidadlista = $_POST['privacidad-lista'];
    $iduser = $_SESSION['idusuario'];
   

    $servListas->crear_lista($nombrelista, $descrlista, $fotoLista, $privacidadlista,$iduser);
}





?>
<br><br>

<div class="container">
    <h2 class="titulo-historial">Wishlist
    <a href="#addWishlistModal" class="btn btn-success" data-toggle="modal" id="add-wishlist">
            <i class="material-icons">&#xE147;</i> 
            <span>Crear Wishlist</span>
        </a>

    </h2>
    <br>
    <?php

    $listasUsuario = $servListas->getListByUser($_SESSION['idusuario']);
    foreach($listasUsuario  as $results => $row){
        //AGREGAR CONDICION SI ES EL USUARIO EL QUE LAS ESTA VIENDO QUE APAREZCAN LAS PRIVADAS SI NO NO
        echo "
        <form method='POST' action='lista.php' class='wishlist-card' id='lista" . $row['id_wishlist'] ."' style='width:300px;'>
        <input type='hidden' name='lista-get' value='" . $row['id_wishlist'] . "'>
        <input type='hidden' name='lista-name' value='" . $row['nombre_lista'] . "'>
            <button type='submit' class='buttonlist'  style='width:300px;'>
                    <div class='card-lista row' style='width:1100px; border: solid black 2px;'>
                        <div class='contenido-lista col-2'>
                        <img style='object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($row['icono_lista']) . "'" . ">
                        </div>
                        <div class='contenido-lista2 col-8'>
                            <br>        
                            <h2>" . $row['nombre_lista'] . "</h2>    
                            <p>" . $row['descripcion_lista'] . "</p><!--Consultar descropcion desde base de datos-->
                        </div>
                    </div>
            </button>
        </form> 
        ";
    }

    ?>
    <br>
</div>

            <div id="addWishlistModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="modal-header">						
                                <h4 class="modal-title">Crear Wishlist</h4>
                                <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">					
                                <div class="form-group">
                                    <label>Nombre de wishlist</label>
                                    <input type="text" id="nombre-lista" name="nombre-lista" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <input type="text" class="form-control" id="descripcion-lista" name="descripcion-lista" required>
                                </div>
                                <br>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto-lista" name="foto-lista" required>
                                    <label class="custom-file-label" for="foto-lista">Foto de wishlist </label>
                                </div>
                                <br>                        <br>
                                <div class="form-group">
                                    <label for="privacidad-lista">Privacidad de wishlist</label>
                                    <select class="form-control" id="privacidad-lista" name="privacidad-lista">
                                        <option value="0">Publica</option>
                                        <option value="1">Privada</option>
                                    </select>
                                </div>			
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-success" value="Agregar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<?php include("includes/footer.php"); ?>
