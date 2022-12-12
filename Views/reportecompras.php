<?php include("includes/header.php");
if(!isset($_SESSION['idusuario'])){
    echo '<script type="text/javascript">';
     echo 'window.location.href="sesion.php";';
     echo '</script>';
     echo '<noscript>';
     echo '<meta http-equiv="refresh" content="0;url=sesion.php" />';
     echo '</noscript>'; exit;
}
require_once("../Database/Database.php");
require_once("../Model/UsuarioModel.php");
require_once("../Model/CategoriasModel.php");
require_once("../Model/CarritoModel.php");

$users = new UserModel();
$categorias = new GestionCategorias();
$allcategory = [];
$allcategoryaux = $categorias->selectCategorias();
foreach ($allcategoryaux as $result => $row){
    $stringCantidad = '<option value=' . $row['id_categoria'] . '>' .  $row['nombre_categoria'] . '</option>';
    array_push($allcategory,$stringCantidad);
}
?>
<div class="container">
    <h2 class="titulo-historial">Pedidos</h2>
    <p class="titulo-historial" style="font-size: 20px">Filtrar por:</p>
    <form method="POST" class='form-filtro' action='#'>
        <select class="filtro" name='filtro-busqueda' class='filtro-busqueda' onchange="ShowCombo(this)">
            <option >Por Rango De Fechas</option>
            <option selected>Por categoría</option>
        </select>

        <div id="category-report">
            <br>
            <?php
                echo '<select id="category-select" name="category-select"> ' 
                . implode("", $allcategory) . '
                </select>';
            ?>
            <br><br>
        </div>

       <div id='Dates' name='dates-search'>
       <br>
            <input type="date" name="date1">
            <input type="date" name="date2">
        <br>       <br>

       </div>
        <input type='submit' id='btn-filtro' class='btn-filtro' name='btn-filtro' value="Filtrar">
    </form>

    <?php
        if(!isset($_POST['filtro-busqueda'])){
            $ventas = new Cart();
            $ventasTotales = $ventas->GetAllOrdersByBuyer($_SESSION['idusuario']);
            foreach ($ventasTotales as $results => $row){
                $UserBuy = $users->GetUserById($row['id_user']);
                $DateTimeAux = $row['purch_date'];
                $DateTime = explode(" ", $DateTimeAux);
                $Date = $DateTime[0];
                $Time = $DateTime[1];
                echo "<div class='orders-card row' >
                        <div class='orders-card col-12'>                
                        <br>
                            <form method='POST'>
                                <h3>ID Pedido: ". $row['orderid'] . "</h3>        
                                <p> Fecha De Compra: " . $Date ." </p>
                                <p> Hora De Compra: " . $Time ." </p>
                                <p> Categoria: ". $row['nombre_categoria'] ."</p>
                                <p> Producto: ". $row['nombre_carrito'] ."</p>
                                <p> Calificación: ". $row['promedio_calificacion'] ."/5 estrellas</p>
                                <p> Precio: $". $row['precio_producto'] ."MXN</p>
                            </form>
                        </div>   
                    </div>";
            }
        }
        if(isset($_POST['filtro-busqueda'])){
            if($_POST['filtro-busqueda'] == 'Por Rango De Fechas'){
                $ventas = new Cart();
                $ventasTotales = $ventas->GetAllOrdersByBuyerByDate($_POST['date1'], $_POST['date2'],$_SESSION['idusuario']);
                foreach ($ventasTotales as $results => $row){
                    $UserBuy = $users->GetUserById($row['id_user']);
                    $DateTimeAux = $row['purch_date'];
                    $DateTime = explode(" ", $DateTimeAux);
                    $Date = $DateTime[0];
                    $Time = $DateTime[1];
                    echo "<div class='orders-card row' >
                            <div class='orders-card col-12'>                
                            <br>
                                <form method='POST'>
                                    <h3>ID Pedido: ". $row['orderid'] . "</h3>        
                                    <p> Fecha De Compra: " . $Date ." </p>
                                    <p> Hora De Compra: " . $Time ." </p>
                                    <p> Categoria: ". $row['nombre_categoria'] ."</p>
                                    <p> Producto: ". $row['nombre_carrito'] ."</p>
                                    <p> Calificación: ". $row['promedio_calificacion'] ."/5 estrellas</p>
                                    <p> Precio: $". $row['precio_producto'] ."MXN</p>
                                </form>
                            </div>   
                        </div>";
                }
            }
            if($_POST['filtro-busqueda'] == 'Por categoría'){
                $ventas = new Cart();
                $ventasTotales = $ventas->GetAllOrdersByBuyerByCategory($_SESSION['idusuario']);
                foreach ($ventasTotales as $results => $row){
                    $UserBuy = $users->GetUserById($row['id_user']);
                    $DateTimeAux = $row['purch_date'];
                    $DateTime = explode(" ", $DateTimeAux);
                    $Date = $DateTime[0];
                    $Time = $DateTime[1];
                    if($row['id_categoria'] == $_POST['category-select']){
                    echo "<div class='orders-card row' >
                            <div class='orders-card col-12'>                
                            <br>
                                <form method='POST'>
                                    <h3>ID Pedido: ". $row['orderid'] . "</h3>        
                                    <p> Fecha De Compra: " . $Date ." </p>
                                    <p> Hora De Compra: " . $Time ." </p>
                                    <p> Categoria: ". $row['nombre_categoria'] ."</p>
                                    <p> Producto: ". $row['nombre_carrito'] ."</p>
                                    <p> Calificación: ". $row['promedio_calificacion'] ."/5 estrellas</p>
                                    <p> Precio: $". $row['precio_producto'] ."MXN</p>
                                </form>
                            </div>   
                        </div>";
                    }
                }
            }
        }
    ?>
</div>
<script type="text/javascript" src="script/reporteVentas.js"></script>

<?php include("includes/footer.php"); ?>
