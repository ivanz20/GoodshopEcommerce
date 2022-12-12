
<?php
    include("includes/header.php");
        $users = new ApiUsuarios();
        $articulos = new GestionProductos();
        if(isset($_POST['id_user_articulo'])) {
             $user_articuloaux = $users->GetUserById($_POST['id_user_articulo']);
             $user_articulo =  $user_articuloaux[0];

             $articulos_publicados = $articulos->getProductsByUser($_POST['id_user_articulo']);
            //  $articulos_publicados = $articulos_publicadosaux[0];
        }
        
?>

<br><br>

<div class="container" id="perfil-container">
    <h2 class="titulo-historial">Información de Perfil</h2>
    <br>


    <?php
        echo "<div class='card-historial row'>
                
                <div class='contenido-articulo col-3'>
                    <img style='object-fit: cover; ' src='data:image/jpeg;base64, " . base64_encode($user_articulo['avatar_imagen']) . "'" . ">
                </div>
                <div class=' contenido-articulo2 col-9'>
                <br>
                    <h2>" . $user_articulo['nombres'] . " " . $user_articulo['apellidopaterno'] . " " . $user_articulo['apellidomaterno'] . "</h2>    <br>        
                    <p><strong>Usuario: </strong>". $user_articulo['nombre_usuario'] ."</p>

                    <p>Fecha de registro: " . $user_articulo['fecha_registro'] . "</p>";

                    if ($user_articulo['privacidad_perfil'] == 0){

                    echo " <form method='post' action='favoritosperfil.php'>
                        <input type=hidden name='id_usuario' value='". $user_articulo['id_usuario'] . "'>
                        <button type='submit'>Ver Wishlists</button>
                    </form>";
                    }
            echo '
                </div>   
            </div>';

        if ($user_articulo['privacidad_perfil'] == 0){
            echo "<div class='card-historial row' style='height: 350px'>
                    <div class=' contenido-articulo2 col-12'>
                    <br>
                        <h2>Datos de Usuario</h2>    <br>   
                        <p><strong>Usuario: </strong>". $user_articulo['nombre_usuario'] ."</p>
                        <p><strong>Nombre: </strong>". $user_articulo['nombres']. " " . $user_articulo['apellidopaterno'] . " " . $user_articulo['apellidomaterno'] ."</p>
                        <p><strong>Correo: </strong>" . $user_articulo['correo_electronico'] . "</p>
                        <p><strong>Fecha de nacimiento: </strong>". $user_articulo['fecha_nacimiento'] . "</p>
                        <p><strong>Sexo: </strong>".  $user_articulo['sexo_usuario'] ."</p>
                
                    </div>   
                </div>";

        echo    '<div class="text-center">
                    <h2>Productos Publicados Recientemente</h2>
                </div>';

                foreach($articulos_publicados as $results => $row){
                    echo
                    "<div class='card mx-auto' id='carta-usuario'>
                        <form method='GET' action='articulo.php'>
                            <input type='hidden' name='articulo' id='articulo' value='" . $row['id_producto'] . "'>
                            <input type='hidden' name='nombrearticulo' id='nombrearticulo' value='" . $row['nombre_producto'] . "'>
                            <button type='submit' class='btn-art-perfil'>
                                <img style='height: 200px; width: 200px; object-fit: cover;' src='data:image/jpeg;base64, " . base64_encode($row['imagen1']) . "'" . ">
                                <h4>" . $row['nombre_producto'] . "</h4>
                            </button>
                        </form>
                    </div>";
                }

        }

        

        if ($user_articulo['privacidad_perfil'] == 1){
            echo '<br> <br> <div class="text-center">
                  
                        <h2>Este perfil es privado, por lo que no puedes ver su información.</h2> <br><br>
                        <img src="https://images.unsplash.com/photo-1617142108319-66c7ab45c711?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8c2FkJTIwZG9nfGVufDB8fDB8fA%3D%3D&w=1000&q=80" class="rounded mx-auto d-block" alt="perrotruste" width=600px> <br><br>
                       
                    </div>';
        }
        
                    


    ?>
    
    <br>
    <br>

</div>