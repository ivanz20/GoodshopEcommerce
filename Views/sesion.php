<?php
    if ( isset($_SESSION['nombre_usuario'])){
        session_start();
        session_destroy();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOODSHOP</title>

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!--Styles-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>



    <div id="background-video" style="background-color: black">

    </div>
    <div class="container text-center login">
        <img src="img/goodshoplogo2.png" width="200">
        <div class="welcome-box row">
            <div class="col-6 foto-index" style="background-image: url('img/interior-design.jpg');">

            </div>
            <div class="col-6 text-index mx-auto">

                <form id="form-login">
                    <h1>Bienvenido</h1>
                    <h3>La mejor calidad para el mejor estilo de vida.</h3>
                        <label for="usuario-inicio">Usuario</label>
                        <input type="text" name="usuario-inicio" id="usuario-inicio">
                        <br>                    <br>
                        <label for="usuario-inicio">Password</label>
                        <input type="password" name="pass-inicio" id="pass-inicio">
                        <button id="btnsesion">Ingresar</button>
                        <br><br>
                        <a  onclick="changeForm()">Registrarse</a>
                </form>

                <form  id="form-signin" enctype="multipart/form-data">

                    <div  id="primera-parte">
                        <h1>Registrarse</h1>
                        <h3>Sé parte de Goodshop.</h3>
                        <label for="email-registro">Correo Electronico</label>
                        <input type="email" name="email-registro" id="email-registro" required>
                        <br><br>
                        <label for="usuario-registro">Usuario</label>
                        <input type="text" name="usuario-registro" id="usuario-registro" required>
                        <br><br>
                        <label for="password-registro">Password</label>
                        <input type="password" name="password-registro" id="password-registro" required>
                        <br><br>
                        <label for="rol-seleccionar">Rol de usuario</label>
                        <br>
                        <select id="rol-seleccionar" name="rol-registro" required>
                            <option value="Comprador">Comprador</option>
                            <option value="Vendedor">Vendedor</option>
                            <option value="Administrador">Administrador</option>

                        </select>
                        <br>
                        <button type="button" onclick="showSignin();">Siguiente</button>
                        <br><br><br>
                        <a onclick="changeForm2();" style="cursor: pointer">Regresar</a>
                        <br><br>
                    </div>
                    <div id="segunda-parte">
                        
                        <input type="text" name="name-segunda" id="name-segunda" placeholder="Nombre(s)" required>
                        <br><br><br>
                        <input type="text" name="apellidopaterno-segunda" id="apellidopaterno-segunda" placeholder="Apellido Paterno" required>
                        <br><br><br>
                        <input type="text" name="apellidomaterno-segunda" id="apellidomaterno-segunda" placeholder="Apellido Materno" required>
                        <br><br><br>
                        <label for="fecha-segunda">Fecha De Nacimiento</label>
                        <input type="date" name="fecha-segunda" id="fecha-segunda" required>
                        <br><br>
                        <label for="sexo-seleccionar">Sexo</label>
                        <br>
                        <select id="sexo-seleccionar" name="sexo-form" required>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    
                        <label for="foto-perfil">Foto de perfil</label>
                        <input id="foto-perfil" name="foto-perfil" type="file" class="file" data-show-preview="true" >                        
                        <button type="submit" onclick="validarForm()">Registrarse</button>
                        <br><br><br>
                        <a onclick="returnSignin();" style="cursor: pointer">Regresar</a>
                    </div>
                    <br><br><br>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="Script/script.js"></script>
    <script type="text/javascript" src="Script/Usuarios.js"></script>



    </body>
</html>