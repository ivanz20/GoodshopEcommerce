<?php include("includes/header.php");
include ('../Database/Database.php');

include("../Model/ProductosModel.php");
include("../Model/CategoriasModel.php");
$productos = new GestionProductos();
$categoriasClase = new GestionCategorias();

if(isset($_POST['delete-product'])) {
    $idproducto = $_POST['delete-product'];
    $productos->deleteProduct($idproducto);
}
if(isset($_POST['editproductonombre'])) {
    $idproducto = $_POST['edit-product'];
    $nombreproducto = $_POST['editproductonombre'];
    $descripcionproducto = $_POST['editdescripcionproducto'];
    $foto1 = addslashes(file_get_contents($_FILES['editfoto1producto']['tmp_name']));
    $foto2 =addslashes(file_get_contents($_FILES['editfoto2producto']['tmp_name']));
    $foto3 =addslashes(file_get_contents($_FILES['editfoto3producto']['tmp_name']));
    $video = addslashes(file_get_contents($_FILES['editvideoproducto']['tmp_name']));
    $categoria = $_POST['editcategoriaproducto'];
    $esCotizacion = $_POST['editcotizacionproducto'];
    if($esCotizacion == 1){
        $cotizacion = "1";
        $venta = "0";
    }else{
        $cotizacion = "0";
        $venta = "1";
    }
    $precioproducto = $_POST['editprecioproducto'];
    $cantidadproducto = $_POST['editcantidadproducto'];
    $vendedorid = $_SESSION['idusuario'];
    $productos->editar_producto($idproducto,$nombreproducto,$descripcionproducto,$foto1,$foto2,$foto3,$video,$venta,$cotizacion,$precioproducto,$cantidadproducto,$vendedorid,$categoria);

}


?>


<div class="container text-center">
    <br>
    <button id="boton-mas" style="width:50%">
        <a href="registroproducto.php" style="text-decoration: none; color: white;">Añadir producto</a>
    </button>
    <br>
    <?php 
          $categories2 = $categoriasClase->selectCategorias();

          $categoriesArray = [];

          foreach($categories2 as $results2 => $row2){
              $stringCategoria = '<option value=' . $row2['id_categoria'] . '>' .  $row2['nombre_categoria'] . '</option>';
              array_push($categoriesArray,$stringCategoria);
          }
        $todosProductos = $productos->getProductsByUser($_SESSION['idusuario']);

        foreach($todosProductos as $results => $row){
        echo
        "<div class='card' id='carta-usuario'>
            <img style='height: 200px; width: 200px; object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($row['imagen1']) . "'" . ">
            <h4>" . $row['nombre_producto'] . "</h4>
            <h4>Stock: " . $row['cantidad_producto'] . "</h4>
            <form class='botones-usercard'method='POST'>
                <button type='button' data-toggle='modal' data-target='#editInfoModal" . $row['id_producto'] . "'><i class='fa-solid fa-pen-to-square'></i></button>
            </form>
            <form  class='botones-usercard' method='POST'>
                <input type='hidden' name='delete-product' value='" . $row['id_producto'] . "'>
                <button type='submit'><i class='fa-sharp fa-solid fa-trash'></i></button>
            </form>
        </div>


        <div class='modal fade' id='editInfoModal" . $row['id_producto'] . "' tabindex='-1' role='dialog' aria-labelledby='editInfoModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='editInfoModalLabel'>Editar Producto</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <!-- Form para cambiar datos -->
                        <form  id='form-cambiarproducto' action='#' method='POST' enctype='multipart/form-data'>
                            <input type='hidden' name='edit-product' value='" . $row['id_producto'] . "'>
                            <div class='form-group'>
                                <label for='nombreproducto'>Nombre del producto</label>
                                <input type='text' class='form-control' id='editproductonombre' name='editproductonombre' value='" . $row['nombre_producto'] . "'>
                            </div>
                            <div class='form-group'>
                                <label for='descripcionproducto'>Descripción</label>
                                <input type='text' class='form-control' id='editdescripcionproducto' name='editdescripcionproducto'  value='" . $row['descripcion_producto'] . "'></input>
                            </div>
                            <br>
                            <div class='custom-file'>
                                <input type='file' class='custom-file-input' id='editfoto1producto' name='editfoto1producto' required>
                                <label class='custom-file-label' for='editfoto1producto'>Foto 1</label>
                            </div>
                            <br><br>
                            <div class='custom-file'>
                                <input type='file' class='custom-file-input' id='editfoto2producto' name='editfoto2producto' required>
                                <label class='custom-file-label' for='editfoto2producto'>Foto 2</label>
                            </div>
                            <br><br>
                            <div class='custom-file'>
                                <input type='file' class='custom-file-input' id='editfoto3producto' name='editfoto3producto' required>
                                <label class='custom-file-label' for='editfoto3producto'>Foto 3</label>
                            </div>
                            <br><br>
                            <div class='custom-file'>
                                <input type='file' class='custom-file-input' id='editvideoproducto' name='editvideoproducto' required>
                                <label class='custom-file-label' for='editvideoproducto'>Video </label>
                            </div>
                            <br><br>
                            <div class='form-group'>
                                <label for='editcategoriaproducto'>Categoria</label>
                                <select class='form-control' id='editcategoriaproducto' name='editcategoriaproducto'>" . 
                                  
                                implode("", $categoriesArray)
                                . "
                                </select>
                            </div>
                            <div class='form-group'>
                                <label for='editcotizacionproducto'>¿Es para cotización?</label>
                                <select class='form-control' id='editcotizacionproducto' name='editcotizacionproducto'>
                                    <option value='1'>Si</option>
                                    <option value='2'>No</option>
                                </select>
                            </div>
                            <div class='form-group'>
                                <label for='editprecioproducto'>Precio del producto</label>
                                <input type='text' class='form-control' id='editprecioproducto' name='editprecioproducto' value='" . $row['precio_producto'] . "'>
                            </div>
                            <div class='form-group'>
                                <label for='editcantidadproducto'>Cantidad del producto</label>
                                <input type='text' class='form-control' id='editcantidadproducto' name='editcantidadproducto' value='" . $row['cantidad_producto'] . "'>
                            </div>
                             <br>
                            <button class='btn btn-primary' type='submit' style='background-color:black; border:none; font-family: 'Roboto', sans-serif;width: 100%'>Editar</button>
                        </form>

                        <!-- Termina form para cambiar datos-->
                    </div>  
                </div>
            </div>
        </div>";}
    ?>
</div>
<br><br><br>
<script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="Script/script.js"></script>
    <script type="text/javascript" src="Script/Productos.js"></script>

<?php include("includes/footer.php")?>