<?php include("includes/header.php");?>
<br><br>
<div class="container">
    <div class="detalles-pedido">
        <h2 class="titulo-historial">Detalles de Pedido</h2>
        <br>
        <p>Pedido el 12 de Septiembre del 2022</p>
        <p>Categoría: Sala</p>
        <br>
        <div class="row cuadro-info">
            <!-- Consulta de informacion de envio desde la base de datos-->
            <div class="col-4">
                <h5>Dirección de envío</h5>
                <p>Ivan Zavala</p>
                <p>Direccion 3334</p>
                <p>Colonia</p>
                <p>Ciudad, Estado</p>
            </div>
            <div class="col-4">
                <h5>Método de pago</h5>
                <p>Tarjeta de Credito VISA</p>
            </div>
            <div class="col-4">
                <h5>Resumen del pedido</h5>
                <p><strong>Productos:</strong>  $1,469.00</p>
                <p><strong>Envío:</strong>  $157.59</p>
                <p><strong>Subtotal:</strong>  $1,626.59</p>
                <p><strong>Total (IVA incluido, en caso de ser aplicable):</strong>  $1,626.59</p>

            </div>
        </div>
        <br>
        <div class="row cuadro-info2">
            <div class="col-8">
                <h5>Entrega estimada para el 15 de septiembre del 2022</h5>
                <div id="entrega-info" style="display: inline-flex">
                    <img src="img/sala.png" width="200">
                    <div>
                        <h2 style="padding-left: 50px">Sala esquinera derecha Yoco - Gris oscuro</h2>
                        <h3>Vendido por: Tecno Planet S de RL de CV</h3>
                        <h4>$1,469.00</h4>
                    </div>
                </div>
            </div>
            <div class="col-4 botones-envio">
                <form><button>Escribir una opinión</button></form>
                <form><button>Reportar un problema</button></form>
            </div>
        </div>
    </div>
</div>
<br><br><br>
<div class="container text-center">
    <h1 style="font-family: 'Roboto', sans-serif">Productos Similares</h1>
    <br>
    <div class="arrow mx-auto" style=" position:relative; display:  inline; bottom: 40px;">
        <button style="background-color: transparent; border: none"><i class="fa-solid fa-arrow-left"></i></button>
    </div>
    <!--For each desde db-->
    <?php for ($x=0; $x<4; $x++){
        echo
        "<div class='card'>
        <img src='img/mesa.png'>
        <h4>Mesa de comedor Talitha 200cm - Nogal</h4>
        <p>$9,999.00 MXN</p>
        <form action='articulo.php'><button type='submit'>Ver Articulo</button></form>
        </div>";
    } ?>
    <div class="arrow mx-auto" style=" position:relative; display:  inline; bottom: 40px;">
        <button style="background-color: transparent; border: none"><i class="fa-solid fa-arrow-right"></i></button>
    </div>
</div>
<br><br><br><br>
<?php include("includes/footer.php"); ?>

