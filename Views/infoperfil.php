<?php
    if(isset($_POST['cerrar-sesion'])){
        session_start();
        session_unset();
        session_destroy();
    }
    if(!isset($_SESSION['idusuario'])){
        echo '<script type="text/javascript">';
         echo 'window.location.href="sesion.php";';
         echo '</script>';
         echo '<noscript>';
         echo '<meta http-equiv="refresh" content="0;url=sesion.php" />';
         echo '</noscript>'; exit;
    }

       
?>

<br><br>

<div class="container" id="perfil-container">
    <h2 class="titulo-historial">Información de Perfil</h2>
    <br>

<!-- Modal -->
<div class="modal fade" id="editInfoModal" tabindex="-1" role="dialog" aria-labelledby="editInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editInfoModalLabel">Editar mis datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <!-- Form para cambiar datos -->
         <form  id="form-cambiarusuario" enctype="multipart/form-data">
            <?php   
                $sexo = $_SESSION['sexo_usuario'];
                $privacidad = $_SESSION['privacidad_perfil'];

                if($sexo === 'Masculino'){
                    $sexoselect = "<option value='Masculino' SELECTED>Masculino</option> <option value='Femenino'>Femenino</option>";

                }else{
                    $sexoselect = "<option value='Masculino'>Masculino</option> <option value='Femenino' SELECTED>Femenino</option>";
                }
                if($privacidad == 0){
                    $privacidadselect = "<option value='1'>Privado</option> <option value='0' SELECTED>Publico</option>";
                }else{
                    $privacidadselect = "<option value='1' SELECTED>Privado</option> <option value='0' >Publico</option>";
                }

                echo"
                <input type='email' name='email-editar' id='email-editar' placeholder='Correo' required  value='" . $_SESSION['correo_electronico']   . "'>
                <br><br>
                <input type='text' name='usuario-editar' id='usuario-editar' placeholder='Usuario' value='". $_SESSION['nombre_usuario']   . "' required>
                <br><br>
                <input type='text' name='name-editar' id='name-editar' placeholder='Nombre(s)' value='" . $_SESSION['nombres'] . "' required>
                <br><br>
                <input type='text' name='apellidopaterno-editar' id='apellidopaterno-editar' placeholder='Apellido Paterno' value=' " . $_SESSION['apellidopaterno']  . "' required>
                <br><br>
                <input type='text' name='apellidomaterno-editar' id='apellidomaterno-editar' placeholder='Apellido Materno' value=' " . $_SESSION['apellidomaterno']  . "'required>
                <br>
                <label for='fecha-editar'>Fecha De Nacimiento</label>
                <input type='date' name='fecha-editar' id='fecha-editar' value='" . $_SESSION['fecha_nacimiento']  . "'required>
                <br>
                <label for='sexo-seleccionar'>Sexo</label>
                <br>
                <select id='sexo-seleccionar' name='sexo-editar' required>" 
                    . $sexoselect . "
                </select>
                <br>
                <label for='privacidad-seleccionar'>Privacidad de perfil</label>
                <br>
                <select id='privacidad-seleccionar' name='privacidad-editar' required>"
                . $privacidadselect . "
                <label for='foto-editar'>Foto de perfil</label>
                        <input id='foto-editar' name='foto-editar' type='file' class='file' data-show-preview='true' >                        

                </select>
                <br><br>   
            ";
            ?>
             
            <!-- <label for="foto-editar">Foto de perfil</label>
            <br>
            <input id="foto-editar" name="foto-editar" type="file" class="file" data-show-preview="false" > -->
            <br><br>

            <button type="submit">Guardar</button>
        </form>

        <!-- Termina form para cambiar datos-->
      </div>
      
    </div>
  </div>
</div>
    <?php
        echo "<div class='card-historial row'>
                
                <div class='contenido-articulo col-3'>
                    <img src='data:image/jpeg;base64, " . base64_encode($_SESSION['avatar_imagen']) . "'" . ">
                </div>
                <div class=' contenido-articulo2 col-9'>
                <br>
                    <h2>" . $_SESSION['nombres'] . " " . $_SESSION['apellidopaterno'] . " " . $_SESSION['apellidomaterno'] . "</h2>    <br>        
                    <p>Fecha de registro: " . $_SESSION['fecharegistro'] . "</p>
                    <form method='post' action='favoritosperfil2.php'>
                        <input type=hidden value='". $_SESSION['idusuario'] . "'>
                        <button type='submit'>Ver Wishlists</button>
                    </form>
                </div>   
            </div>";
    echo "<div class='card-historial row' style='height: 350px'>
                <div class=' contenido-articulo2 col-12'>
                <br>
                    <h2>Mis Datos</h2>    <br>   
                    <p><strong>Usuario: </strong>". $_SESSION['nombre_usuario'] ."</p>
                    <p><strong>Nombre: </strong>". $_SESSION['nombres']. " " . $_SESSION['apellidopaterno'] . " " . $_SESSION['apellidomaterno'] ."</p>
                    <p><strong>Correo: </strong>" . $_SESSION['correo_electronico'] . "</p>
                    <p><strong>Fecha de nacimiento: </strong>". $_SESSION['fecha_nacimiento'] . "</p>
                    <p><strong>Sexo: </strong>".  $_SESSION['sexo_usuario'] ."</p>
                    <!-- Consultar info desde tabla de historial -->
                    <button type='button'data-toggle='modal' data-target='#editInfoModal'>Editar mis datos</button>
                </div>   
            </div>";


   
                    


    ?>
    <div class="text-center">
        <br>
        <?php 
            $btnAprobar = '<br><button id="boton-mas"><a href="aprobarproductos.php" style="text-decoration: none; color: white;">Aprobación de articulos</a></button><br>';
            $btnRegistroProductos = '<br><button id="boton-mas"><a href="gestionproductos.php" style="text-decoration: none; color: white;">Gestión de productos</a></button><br>';
            $btnGestionCategorias = '<br><button id="boton-mas"><a href="categorias.php" style="text-decoration: none; color: white;">Gestión de Categorías</a></button><br>';
            $btnReporteVentas = '<br><button id="boton-mas"><a href="reporteventas.php" style="text-decoration: none; color: white;">Reporte de ventas</a></button><br>';
            $btnCotizaciones = '<br><button id="boton-mas"><a href="cotizaciones.php" style="text-decoration: none; color: white;">Cotizaciones</a></button><br>';
            $btnCerrar = '
            <br>
                <form method="POST" action="#">
                    <input type="hidden" name="cerrar-sesion">
                    <button type="submit" id="boton-mas">Cerrar Sesion</button>
                </form
                        <br>';
            $btnReportePedidos = '<br><button id="boton-mas"><a href="reportecompras.php" style="text-decoration: none; color: white;">Pedidos</a></button><br>';
        

            if($_SESSION['rol_usuario'] == 'Vendedor'){
                echo $btnRegistroProductos;
                echo $btnGestionCategorias;
                echo $btnReporteVentas;
                echo $btnCotizaciones;
                echo  $btnCerrar;
            }

            if($_SESSION['rol_usuario'] == "Administrador"){
                include ('../Database/Database.php');
                include("../Model/UsuarioModel.php");
               $ser_user = new UserModel();
               include("../Model/ProductosModel.php");
                $ser_productos = new GestionProductos();
                $todosProductos = $ser_productos->searchByAdminID($_SESSION['idusuario']);
                echo '<h2>Productos Aprobados Por Ti</h2>';
                foreach($todosProductos as $results => $row){

                    $user = $ser_user->GetUserById($row['vendedor_id']);
                    echo
                    "
                    <div class='card' id='carta-usuario'>
                        <img style='height: 200px; width: 200px; object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($row['imagen1']) . "'" . ">
                        <h4>" . $row['nombre_producto'] . "</h4>
                        <h4>Stock: " . $row['cantidad_producto'] . "</h4>
                        <p>Precio: $" . $row['precio_producto'] . "MXN</p>
                        <p>Usuario: " . $user[0]['nombre_usuario'] . "</p>
                    </div>";
                }
                echo '<br><br>';
                echo $btnAprobar;
                echo  $btnCerrar;
            }
        
            if($_SESSION['rol_usuario'] == "Comprador"){
                echo $btnCotizaciones;
                echo $btnReportePedidos;
                echo  $btnCerrar;
            }
        ?>
        
        
        

    </div>
    <br>
    <br>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="Script/script.js"></script>
    <script type="text/javascript" src="Script/Usuarios.js"></script>
