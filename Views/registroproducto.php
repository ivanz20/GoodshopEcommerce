<?php 
include("includes/header.php");
include ('../Database/Database.php');
include("../Model/CategoriasModel.php");
$categoriasClase = new GestionCategorias();




?>
<div class="container">
    <br><br>
    <form id="registrarproducto"  enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombreproducto">Nombre del producto</label>
            <input type="text" class="form-control" id="nombreproducto" name="nombreproducto">
        </div>
        <div class="form-group">
            <label for="descripcionproducto">Descripción</label>
            <textarea class="form-control" id="descripcionproducto" name="descripcionproducto" rows="3"></textarea>
        </div>
        <br>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="foto1producto" name="foto1producto" required>
            <label class="custom-file-label" for="foto1producto">Foto 1</label>
        </div>
        <br><br>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="foto2producto" name="foto2producto" required>
            <label class="custom-file-label" for="foto2producto">Foto 2</label>
        </div>
        <br><br>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="foto3producto" name="foto3producto" required>
            <label class="custom-file-label" for="foto3producto">Foto 3</label>
        </div>
        <br><br>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="videoproducto" name="videoproducto" required>
            <label class="custom-file-label" for="videoproducto">Video </label>
        </div>
        <br><br>
        <div class="form-group">
            <label for="categoriaproducto">Categoria</label>
            <select class="form-control" id="categoriaproducto" name="categoriaproducto">
                <?php
                $categories = $categoriasClase->selectCategorias();
                foreach($categories as $results => $row){
                    echo "<option value=" . $row['id_categoria'] . ">" .  $row['nombre_categoria'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="cotizacionproducto">¿Es para cotización?</label>
            <select class="form-control" id="cotizacionproducto" name="cotizacionproducto">
                <option value="1">Si</option>
                <option value="2">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="precioproducto">Precio del producto</label>
            <input type="text" class="form-control" id="precioproducto" name="precioproducto">
        </div>
        <div class="form-group">
            <label for="cantidadproducto">Cantidad del producto</label>
            <input type="text" class="form-control" id="cantidadproducto" name="cantidadproducto">
        </div>
        <br>
        <button class="btn btn-primary" type="submit" style="background-color:black; border:none; font-family: 'Roboto', sans-serif;width: 100%">Registrar producto</button>
    </form>
    <br><br>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="Script/script.js"></script>
    <script type="text/javascript" src="Script/Productos.js"></script>

<?php include("includes/footer.php")?>

