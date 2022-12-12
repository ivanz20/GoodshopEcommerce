<?php include("includes/header.php");
include ('../Database/Database.php');

include("../Model/UsuarioModel.php");
include("../Model/ProductosModel.php");

$ser_productos = new GestionProductos();
$ser_user = new UserModel();

if(isset($_POST['aprobar-producto'])){
    $ser_productos->UpdateAprob($_POST['aprobar-producto'],$_SESSION['idusuario']);
}
?>
<br><br>

<div class="container">
    <h2 class="titulo-historial">Aprobar productos</h2>
    <br>
    <?php
        $todosProductos = $ser_productos->searchByAuth();
         foreach($todosProductos as $results => $row){

            $user = $ser_user->GetUserById($row['vendedor_id']);

            echo
            "<div class='card' id='carta-usuario'>
                <img style='height: 200px; width: 200px; object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($row['imagen1']) . "'" . ">
                <h4>" . $row['nombre_producto'] . "</h4>
                <h4>Stock: " . $row['cantidad_producto'] . "</h4>
                <p>Precio: $" . $row['precio_producto'] . "MXN</p>
                <p>Usuario: " . $user[0]['nombre_usuario'] . "</p>
                <form class='botones-usercard'method='POST'>
                    <input type='hidden' name='aprobar-producto' value='". $row['id_producto'] ."'>
                    <button type='submit'>Aprobar</button>
                </form>
            </div>";
         }
    
    ?>
    <br>
    <br><br>
</div>
<?php include("includes/footer.php"); ?>
