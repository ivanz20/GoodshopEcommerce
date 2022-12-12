<?php include("includes/header.php");
include ('../Database/Database.php');

include("../Model/ProductosModel.php");
$productos = new GestionProductos();
$todosProductos = $productos->getAllProducts();

if(!isset($_SESSION['idusuario'])){
    echo '<script type="text/javascript">';
    echo 'window.location.href="sesion.php";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=sesion.php" />';
    echo '</noscript>'; exit;
}

    echo "<br><br>
    <div class='container text-center' style='font-family:'Roboto', sans-serif;'>
        <h1>Bienvenid@, ".$_SESSION['nombres'] ." ☺</h1>
    </div>";
    ?>
<br><br>

<div class="container">
    <div class="photodump">
            <h2>Almacenaje</h2>
            <p>Gran espacio, buenos materiales y toda la calidad que tu familia necesita.</p>
            <a href="www.youtube.com" id="more-button">Ver más
                <div id="pintaturayaconcomex"></div>
            </a>
            <!-- Aqui va un slideshow-->
            <img class="muebles" src="../Views/img/mueble-1.png" alt="mueble">
    </div>
</div>

<br><br><br><br>

<br>
   
<div class="container text-center" id="container-productos">
    
    

    <span class="row" id="productos-inicio">
        <?php         
        foreach($todosProductos as $results => $row){
            if($row['aprobado'] == 1){
                echo
                "<div class='card inicio-cards'>
                <img style='height: 200px; width: 200px; object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($row['imagen1']) . "'" . ">
                <h4>" . $row['nombre_producto'] . "</h4>
                ";
                if($row['cotizacion'] == 0){
                    echo "<p> $" .  $row['precio_producto'] . " MXN</p>";
                }else{
                    echo "<p>¡Cotizalo ahora!</p>";
                }
                echo "
                <form action='articulo.php' method='GET' id='form" . $row['id_producto'] . "'>
                <input type='hidden' name='articulo' id='articulo' value='" . $row['id_producto'] . "'>
                <input type='hidden' name='nombrearticulo' id='nombrearticulo' value='" . $row['nombre_producto'] . "'>
                <button type='submit'>Ver Articulo</button></form>
                </div>";
            }
           
        } ?>
    </span>

</div>
<div class="container">
    <div class="pet-shop">
        <h1> <img src="img/goodshoplogo.png" width="150"> PETS <i class="fa-solid fa-paw"></i></h1>
        <p>Lo mejor para el consentido de tu hogar.</p>
        <a href="www.youtube.com" id="more-button">Ver más
            <div id="pintaturayaconcomex2"></div>
        </a>
        <img src="img/cat1.png">
        <div id="barradeco"></div>
    </div>
</div>
<br><br><br><br><br><br><br>
    <div class="container">
            <ul id="cat-horizontal">
                <li class="lista-categorias">
                    <button id="btn-recien" class="btn-dashboard">Recien Llegados</button>
                </li>
                <li class="lista-categorias">
                    <button id="btn-popu" class="btn-dashboard">Populares</button>
                </li>
                <li class="lista-categorias">
                    <button id="btn-vendidos" class="btn-dashboard">Más Vendidos</button>
                </li">
                <li class="lista-categorias">
                    <button id="btn-recomendados" class="btn-dashboard">Recomendados</button>
                </li>
            </ul>
    </div>

<br><br>


    <div class="container text-center" id="group-recien">

       
        <?php
        $recienllegados = $productos->ProductosRecienLlegados();
        
        foreach ($recienllegados as $result => $row){
            echo
            "<div class='card inicio-cards'>
                <img style='height: 200px; width: 200px; object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($row['imagen1']) . "'" . ">
                <h4>" . $row['nombre_producto'] . "</h4>
                ";
                if($row['cotizacion'] == 0){
                    echo "<p> $" .  $row['precio_producto'] . " MXN</p>";
                }else{
                    echo "<p>¡Cotizalo ahora!</p>";
                }
                echo "
                <form action='articulo.php' method='GET' id='form" . $row['id_producto'] . "'>
                <input type='hidden' name='articulo' id='articulo' value='" . $row['id_producto'] . "'>
                <input type='hidden' name='nombrearticulo' id='nombrearticulo' value='" . $row['nombre_producto'] . "'>
                <button type='submit'>Ver Articulo</button></form>
                </div>";
        } ?>
        
    </div>


    <div class="container text-center" id="group-populares">

       
        <?php
        $recienllegados = $productos->ProductosPopulares();

        foreach ($recienllegados as $result => $row){
            echo
            "<div class='card inicio-cards'>
                <img style='height: 200px; width: 200px; object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($row['imagen1']) . "'" . ">
                <h4>" . $row['nombre_producto'] . "</h4>
                ";
                if($row['cotizacion'] == 0){
                    echo "<p> $" .  $row['precio_producto'] . " MXN</p>";
                }else{
                    echo "<p>¡Cotizalo ahora!</p>";
                }
                echo "
                <form action='articulo.php' method='GET' id='form" . $row['id_producto'] . "'>
                <input type='hidden' name='articulo' id='articulo' value='" . $row['id_producto'] . "'>
                <input type='hidden' name='nombrearticulo' id='nombrearticulo' value='" . $row['nombre_producto'] . "'>
                <button type='submit'>Ver Articulo</button></form>
                </div>";
        } ?>

    </div>

    <div class="container text-center" id="group-masvendidos">

       
        <?php
        $recienllegados = $productos->ProductosMasVendidos();

        foreach ($recienllegados as $result => $row){
            echo
            "<div class='card inicio-cards'>
                <img style='height: 200px; width: 200px; object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($row['imagen1']) . "'" . ">
                <h4>" . $row['nombre_producto'] . "</h4>
                ";
                if($row['cotizacion'] == 0){
                    echo "<p> $" .  $row['precio_producto'] . " MXN</p>";
                }else{
                    echo "<p>¡Cotizalo ahora!</p>";
                }
                echo "
                <form action='articulo.php' method='GET' id='form" . $row['id_producto'] . "'>
                <input type='hidden' name='articulo' id='articulo' value='" . $row['id_producto'] . "'>
                <input type='hidden' name='nombrearticulo' id='nombrearticulo' value='" . $row['nombre_producto'] . "'>
                <button type='submit'>Ver Articulo</button></form>
                </div>";
        } ?>
    </div>

    <div class="container text-center" id="group-recomendados">
        <?php
        $recienllegados = $productos->ProductosRecomedados();

        foreach ($recienllegados as $result => $row){
            echo
            "<div class='card inicio-cards'>
                <img style='height: 200px; width: 200px; object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($row['imagen1']) . "'" . ">
                <h4>" . $row['nombre_producto'] . "</h4>
                ";
                if($row['cotizacion'] == 0){
                    echo "<p> $" .  $row['precio_producto'] . " MXN</p>";
                }else{
                    echo "<p>¡Cotizalo ahora!</p>";
                }
                echo "
                <form action='articulo.php' method='GET' id='form" . $row['id_producto'] . "'>
                <input type='hidden' name='articulo' id='articulo' value='" . $row['id_producto'] . "'>
                <input type='hidden' name='nombrearticulo' id='nombrearticulo' value='" . $row['nombre_producto'] . "'>
                <button type='submit'>Ver Articulo</button></form>
                </div>";
        } ?>
    </div>




    <br><br><br><br>
<div class="container">
    <div class="embed-responsive embed-responsive-16by9">
        <iframe width="560" height="315" src="videos/housetour.mp4" title="YouTube video player"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    </div>
</div>
<br><br>    <br><br><br><br>
<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script type="text/javascript" src="../Views/Script/script.js"></script>
<?php include("includes/footer.php"); ?>