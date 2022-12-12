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

include("../Model/UsuarioModel.php");
include("../Model/CategoriasModel.php");
include("../Model/CarritoModel.php");

$users = new UserModel();
$categorias = new GestionCategorias();
$allcategory = [];
$allcategoryaux = $categorias->selectCategorias();
foreach ($allcategoryaux as $result => $row){
    $stringCantidad = '<option value=' . $row['id_categoria'] . '>' .  $row['nombre_categoria'] . '</option>';
    array_push($allcategory,$stringCantidad);
}
?>
<br><br>

<div class="container">
    <h2 class="titulo-historial">Reporte de Ventas</h2>
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

        <select class="tipo-consulta" name='tipo-consulta' class='tipo-consulta'>
            <option >Consulta Detallada</option>
            <option>Consulta Agrupada</option>
        </select>

        <br><br>
        <input type='submit' id='btn-filtro' class='btn-filtro' name='btn-filtro' value="Filtrar">
    </form>

    <br><br>
    <?php
    if(!isset($_POST['tipo-consulta'])){
        include("../Model/CarritoModel.php");
        $ventas = new Cart();
        $ventasTotales = $ventas->GetAllOrdersByVendor($_SESSION['idusuario']);
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
                            <p> Comprado por: " . $UserBuy[0]['nombre_usuario'] ."</p>
                            <p> Categoria: ". $row['nombre_categoria'] ."</p>
                            <p> Producto: ". $row['nombre_carrito'] ."</p>
                            <p> Precio: $". $row['precio_producto'] ."MXN</p>
                            <p> Cantidad en stock: ". $row['cantidad_producto'] ."</p>
                            <p> Calificación: ". $row['promedio_calificacion'] ."/5 estrellas</p>
                        </form>
                    </div>   
                </div>";
        }
    }
    if(isset($_POST['tipo-consulta'])){
        if($_POST['tipo-consulta'] == 'Consulta Detallada'){
            if($_POST['filtro-busqueda'] == 'Por Rango De Fechas'){
                $ventas = new Cart();
                $ordersDate = $ventas->GetAllOrdersByDate($_POST['date1'], $_POST['date2'],$_SESSION['idusuario']);
                foreach ($ordersDate as $results => $row){
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
                                <p> Comprado por: " . $UserBuy[0]['nombre_usuario'] ."</p>
                                <p> Categoria: ". $row['nombre_categoria'] ."</p>
                                <p> Producto: ". $row['nombre_carrito'] ."</p>
                                <p> Precio: $". $row['precio_producto'] ."MXN</p>
                                <p> Cantidad en stock: ". $row['cantidad_producto'] ."</p>
                                <p> Calificación: ". $row['promedio_calificacion'] ."/5 estrellas</p>
                                </form>
                            </div>   
                        </div>";
                }
            }
            if($_POST['filtro-busqueda'] == 'Por categoría'){
                $ventas = new Cart();
                $ordersDate = $ventas->GetAllOrdersByCategory($_SESSION['idusuario']);
                foreach ($ordersDate as $results => $row){
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
                                <p> Comprado por: " . $UserBuy[0]['nombre_usuario'] ."</p>
                                <p> Categoria: ". $row['nombre_categoria'] ."</p>
                                <p> Producto: ". $row['nombre_carrito'] ."</p>
                                <p> Precio: $". $row['precio_producto'] ."MXN</p>
                                <p> Cantidad en stock: ". $row['cantidad_producto'] ."</p>
                                <p> Calificación: ". $row['promedio_calificacion'] ."/5 estrellas</p>
                                </form>
                            </div>   
                        </div>";
                    }   
                }
            }
           
        }        
        if($_POST['tipo-consulta'] == 'Consulta Agrupada'){            
            if($_POST['filtro-busqueda'] == 'Por Rango De Fechas'){
                $ventas = new Cart();
                $ordersDate = $ventas->GetAllOrdersByDateGroup($_POST['date1'], $_POST['date2'],$_SESSION['idusuario']);
                foreach ($ordersDate as $results => $row){
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
                                <p> Comprado por: " . $UserBuy[0]['nombre_usuario'] ."</p>
                                <p> Precio Venta: $". $row['precio_carrito'] ."MXN</p>
                                </form>
                            </div>   
                        </div>";
                }
            }
            if($_POST['filtro-busqueda'] == 'Por categoría'){
                $ventas = new Cart();
                $ordersDate = $ventas->GetAllOrdersByCategoryGroup($_SESSION['idusuario']);
                foreach ($ordersDate as $results => $row){
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
                                <p> Comprado por: " . $UserBuy[0]['nombre_usuario'] ."</p>
                                <p> Precio Venta: $". $row['precio_carrito'] ."MXN</p>
                                </form>
                            </div>   
                        </div>";
                    }   
                }
            }
        }
        
    }
    ?>
    <br>
 
    <br><br>
    
</div>
<script type="text/javascript" src="script/reporteVentas.js"></script>

<?php include("includes/footer.php"); ?>
