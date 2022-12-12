<?php include("includes/header.php");?>
<br><br>

<div class="container">

    <h2 class="titulo-historial">Pedidos</h2>
    <br>

    <p class="titulo-historial" style="font-size: 20px">Ordendar por:</p>
    <select class="filtro">
        <option>Por fecha</option>
        <option>Por categoría</option>
    </select>
    <br>    <br><br>

    <?php
    for($x=0; $x < 5; $x++){
        echo "<div class='card-historial row'>
                <div class='contenido-articulo col-3'>
                    <img src='img/sala.png'>
                </div>
                <div class=' contenido-articulo2 col-9'>
                <br>
                    <h2>Mesa de comedor Talitha 200cm - Nogal</h2>    <br>        
                    <p>La Sala esquinera Yoco está inspirada en el estilo industrial que da protagonismo a lo versátil y atemporal. Su casco de madera de pino, hule espuma de alta densidad, tapizado en terciopelo y pata metálica, lo hacen una pieza cómoda y de gran diseño para tu hogar.</p><!--Consultar descropcion desde base de datos-->
                    <p>Comprando en: Lunes 12 de Septiembre del 2022</p>
                    <!-- Consultar info desde tabla de historial -->
                    <form action='articulo_pedido.php'><button type='submit'>Ver Pedido</button></form>
                    
                </div>   
            </div>";
    }
    ?>
    <br>
    <div class="mx-auto text-center" >
        <button id="boton-mas">Más</button>
    </div>
    <br><br>
</div>
<?php include("includes/footer.php"); ?>
