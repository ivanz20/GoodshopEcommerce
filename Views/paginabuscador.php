<?php include("includes/header.php");
include("../Model/ProductosModel.php");
$productos = new GestionProductos();

if(isset($_GET['filtro-busqueda'])){
    $opcion = $_GET['filtro-busqueda'];
    $textobuscado = $_GET['busqueda-item'];
   switch($opcion){
    case 1:
        $todosProductos = $productos->searchByNamePrecioMenorAMayor($textobuscado);
        break;
    case 2:
        $todosProductos = $productos->searchByNamePrecioMayorAMenor($textobuscado);

        break;
    case 3:
        $todosProductos = $productos->searchByNameMejorCalificados($textobuscado);
        break;
    default:
        $todosProductos = $productos->searchByName($nombre);
        break;
   }
}
?>

<div class="container text-center">
    <br>    <br>

    <form method="GET" action="#">
        <?php
            if(isset($_POST['barrabusqueda'])){
                echo '<input type="hidden" name="busqueda-item" id="busqueda-item" value="' . $_POST['barrabusqueda'] . '">';
            }
            else{
                echo '<input type="hidden" name="busqueda-item" id="busqueda-item" value="' . $_GET['busqueda-item'] . '">';
            }
        ?>
        <div class="form-row">
        <div class="form-group col-md-4">
        <select id="filtro-busqueda" name ='filtro-busqueda'class="form-control">
            <option selected value="1">Menor a Mayor Precio</option>
            <option value="2"> Mayor a Menor Precio</option>
            <option value="3">Mejor Calificados</option>
        </select>
        </div>
        <div class="form-group col-md-2">
            <button type="submit" class="form-control" id="inputZip">Aplicar Filtro</button>
        </div>
    </div>
    
    </form>
    
    <br>
    <?php
        if(isset($_POST['barrabusqueda'])){ 
            $nombre = $_POST['barrabusqueda'];
        }else{
            $nombre = $_GET['busqueda-item'];
        }

        if(strlen($nombre)>0){
            if(isset($_POST['barrabusqueda'])){
                $todosProductos = $productos->searchByName($nombre);
            }
        }
        else{
            $todosProductos= $productos->getAllProducts();
        }
            foreach($todosProductos as $results => $row){
                echo
                "<div class='card inicio-cards'>
                <img style='height: 200px; width: 200px; object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($row['imagen1']) . "'" . ">
                <h4>" . $row['nombre_producto'] . "</h4>
                <p> $" .  $row['precio_producto'] . " MXN</p>";
                echo "
                    <div class='estrellas-busqueda'>
                    <p>Calificación:" ;
                    $numestrellas = $row['promedio_calificacion'];
                    for ($stars=0; $stars<$numestrellas; $stars++){
                        echo '<i class="fa-solid fa-star"></i>';
                    }
                    $numestrellasVacias = 5 - $numestrellas;
                    for ($stars2=0; $stars2<$numestrellasVacias; $stars2++){
                        echo '<i class="fa-regular fa-star"></i>';
                    }
                    echo "</p></div>";
                echo "<form action='articulo.php' method='GET' id='form" . $row['id_producto'] . "'>
                <input type='hidden' name='articulo' id='articulo' value='" . $row['id_producto'] . "'>
                <input type='hidden' name='nombrearticulo' id='nombrearticulo' value='" . $row['nombre_producto'] . "'>
                <button type='submit'>Ver Articulo</button></form>
                </div>";}
      
    ?>
</div>





<?php include("includes/footer.php"); ?>
